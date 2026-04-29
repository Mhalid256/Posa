<?php

namespace App\Http\Controllers\Vendor\Employee;

use App\Contracts\Repositories\VendorEmployeeRepositoryInterface;
use App\Contracts\Repositories\VendorRoleRepositoryInterface;
use App\Enums\ViewPaths\Vendor\VendorEmployee as VendorEmployeePaths;
use App\Enums\WebConfigKey;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Vendor\VendorEmployeeAddRequest;
use App\Http\Requests\Vendor\VendorEmployeeUpdateRequest;
use App\Services\VendorEmployeeService;
use App\Traits\PaginatorTrait;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class VendorEmployeeController extends BaseController
{
    use PaginatorTrait;

    public function __construct(
        private readonly VendorEmployeeRepositoryInterface $employeeRepo,
        private readonly VendorRoleRepositoryInterface     $roleRepo,
        private readonly VendorEmployeeService             $employeeService,
    ) {}

    public function index(Request|null $request, string $type = null): View
    {
        return $this->getListView($request);
    }

    /* ------------------------------------------------------------------ */
    /*  List                                                                */
    /* ------------------------------------------------------------------ */

    public function getListView(Request $request): View
    {
        $vendorId = auth('seller')->id();

        $employee_roles = $this->roleRepo->getVendorRoleList(
            vendorId: $vendorId,
            dataLimit: 'all'
        );

        $employees = $this->employeeRepo->getListWhere(
            orderBy: ['id' => 'desc'],
            searchValue: $request['searchValue'],
            filters: [
                'vendor_id'      => $vendorId,
                'vendor_role_id' => $request['vendor_role_id'] ?? 'all',
            ],
            relations: ['role'],
            dataLimit: getWebConfig(name: WebConfigKey::PAGINATION_LIMIT)
        );

        return view(VendorEmployeePaths::LIST[VIEW], compact('employees', 'employee_roles'));
    }

    /* ------------------------------------------------------------------ */
    /*  Add                                                                 */
    /* ------------------------------------------------------------------ */

    public function getAddView(): View
    {
        $vendorId     = auth('seller')->id();
        $employee_roles = $this->roleRepo->getVendorRoleList(vendorId: $vendorId, dataLimit: 'all');
        return view(VendorEmployeePaths::ADD[VIEW], compact('employee_roles'));
    }

   public function add(VendorEmployeeAddRequest $request): RedirectResponse
{
    $vendorId = auth('seller')->id();
    
    // Handle profile image
    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $this->employeeService->uploadImage($request->file('image'), 'vendor/employee');
    }
    
    // Handle identity images (multiple)
    $identityImages = [];
    if ($request->hasFile('identity_image')) {
        foreach ($request->file('identity_image') as $img) {
            $identityImages[] = $this->employeeService->uploadImage($img, 'vendor/employee/identity');
        }
    }
    
    $data = $this->employeeService->buildEmployeeData($request);
    $data['vendor_id']      = $vendorId;
    $data['status']         = 1;
    $data['created_at']     = now();
    $data['image']          = $imagePath;
    $data['identify_image'] = json_encode($identityImages);
    
    $this->employeeRepo->add(data: $data);
    ToastMagic::success(translate('employee_added_successfully'));
    return redirect()->route('vendor.employee.list');
}

    /* ------------------------------------------------------------------ */
    /*  View details                                                        */
    /* ------------------------------------------------------------------ */

    public function getView(Request $request): View
    {
        $vendorId = auth('seller')->id();
        $employee = $this->employeeRepo->getFirstWhere(
            params: ['id' => $request['id'], 'vendor_id' => $vendorId],
            relations: ['role']
        );
        return view(VendorEmployeePaths::VIEW_DETAILS[VIEW], compact('employee'));
    }

    /* ------------------------------------------------------------------ */
    /*  Update                                                              */
    /* ------------------------------------------------------------------ */

    public function getUpdateView(int $id): View
    {
        $vendorId = auth('seller')->id();
        $employee = $this->employeeRepo->getFirstWhere(
            params: ['id' => $id, 'vendor_id' => $vendorId]
        );
        $employee_roles = $this->roleRepo->getVendorRoleList(vendorId: $vendorId, dataLimit: 'all');
        return view(VendorEmployeePaths::UPDATE[VIEW], compact('employee', 'employee_roles'));
    }

    public function update(VendorEmployeeUpdateRequest $request): RedirectResponse
{
     $vendorId = auth('seller')->id();
    $existing = $this->employeeRepo->getFirstWhere(
        params: ['id' => $request['id'], 'vendor_id' => $vendorId]
    );

    if (!$existing) {
        ToastMagic::error(translate('employee_not_found'));
        return back();
    }

    // Pass the model, NOT $existing->toArray()
    $data = $this->employeeService->buildEmployeeData($request, $existing);
    
    // Handle profile image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($existing->image) {
            $this->employeeService->deleteImage($existing->image);
        }
        $data['image'] = $this->employeeService->uploadImage($request->file('image'), 'vendor/employee');
    }
    
    // Handle identity images upload (replace all)
    if ($request->hasFile('identity_image')) {
        // Delete old identity images
        $oldImages = json_decode($existing->identify_image, true) ?? [];
        foreach ($oldImages as $oldImg) {
            $this->employeeService->deleteImage($oldImg);
        }
        
        $identityImages = [];
        foreach ($request->file('identity_image') as $img) {
            $identityImages[] = $this->employeeService->uploadImage($img, 'vendor/employee/identity');
        }
        $data['identify_image'] = json_encode($identityImages);
    }
    
    $this->employeeRepo->update(id: $request['id'], data: $data);
    
    // Clear any cached employee data in session
    session()->forget('vendor_employee_permissions_' . $request['id']);
    
    ToastMagic::success(translate('employee_updated_successfully'));
    return redirect()->route('vendor.employee.list');
}
    /* ------------------------------------------------------------------ */
    /*  Status toggle                                                       */
    /* ------------------------------------------------------------------ */

    public function updateStatus(Request $request): JsonResponse
    {
        $vendorId = auth('seller')->id();
        $employee = $this->employeeRepo->getFirstWhere(
            params: ['id' => $request['id'], 'vendor_id' => $vendorId]
        );

        if (!$employee) {
            return response()->json(['success' => 0, 'message' => translate('employee_not_found')], 404);
        }

        $this->employeeRepo->update(id: $request['id'], data: ['status' => $request->get('status', 0)]);
        return response()->json([
            'status'  => 'success',
            'message' => translate('Status_Updated'),
        ]);
    }

    /* ------------------------------------------------------------------ */
    /*  Delete                                                              */
    /* ------------------------------------------------------------------ */

    
public function delete(Request $request): JsonResponse
    {
        try {
            $vendorId = auth('seller')->id();
            $employeeId = $request->input('id');

            $employee = $this->employeeRepo->getFirstWhere([
                'id' => $employeeId,
                'vendor_id' => $vendorId
            ]);

            if (!$employee) {
                return response()->json(['success' => 0, 'message' => translate('employee_not_found')], 404);
            }

            // Delete profile image
            if ($employee->image) {
                $this->employeeService->deleteImage($employee->image);
            }

            // Delete identity images
            $identityImages = json_decode($employee->identify_image, true) ?? [];
            foreach ($identityImages as $img) {
                $this->employeeService->deleteImage($img);
            }

            // Delete the employee record
            $this->employeeRepo->delete(['id' => $employeeId, 'vendor_id' => $vendorId]);

            return response()->json([
                'success' => 1,
                'message' => translate('employee_deleted_successfully'),
            ]);
        } catch (\Exception $e) {
            Log::error('Employee delete error: ' . $e->getMessage());
            return response()->json([
                'success' => 0,
                'message' => translate('something_went_wrong'),
            ], 500);
        }
    }
}

