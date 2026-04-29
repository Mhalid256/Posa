<?php

namespace App\Http\Controllers\Vendor\Employee;

use App\Contracts\Repositories\VendorEmployeeRepositoryInterface;
use App\Contracts\Repositories\VendorRoleRepositoryInterface;
use App\Enums\ViewPaths\Vendor\VendorEmployeeRole as VendorRolePaths;
use App\Http\Controllers\BaseController;
use App\Http\Requests\Vendor\VendorRoleRequest;
use App\Traits\PaginatorTrait;
use Devrabiul\ToastMagic\Facades\ToastMagic;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class VendorRoleController extends BaseController
{
    use PaginatorTrait;

    const VENDOR_ROLE_MODULE_PERMISSION = [
        'dashboard',
        'pos_management',
        'order_management',
        'product_management',
        'promotion_management',
        'review_management',
        'customer_section',
        'report',
        'delivery_man',
        'coupon_management',
        'shop_settings',
        'business_settings',
        'employee_management',
        'chat',
    ];

    public function __construct(
        private readonly VendorRoleRepositoryInterface     $roleRepo,
        private readonly VendorEmployeeRepositoryInterface $employeeRepo,
    ) {}

    public function index(Request|null $request, string $type = null): View
    {
        return $this->getAddView($request);
    }

    public function getAddView(Request $request): View
    {
        $vendorId = auth('seller')->id();
        $vendorRolePermissions = self::VENDOR_ROLE_MODULE_PERMISSION;
        $roles = $this->roleRepo->getVendorRoleList(
            vendorId: $vendorId,
            orderBy: ['id' => 'desc'],
            searchValue: $request['searchValue'],
        );
        return view(VendorRolePaths::INDEX[VIEW], compact('roles', 'vendorRolePermissions'));
    }

    public function add(VendorRoleRequest $request): RedirectResponse
    {
        $vendorId = auth('seller')->id();
        $data = [
            'vendor_id'     => $vendorId,
            'name'          => $request['name'],
            'module_access' => json_encode($request['modules']),
            'status'        => 1,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
        $this->roleRepo->add(data: $data);
        ToastMagic::success(translate('role_added_successfully'));
        return back();
    }

    public function getUpdateView(int $id): View
    {
        $vendorId = auth('seller')->id();
        $vendorRolePermissions = self::VENDOR_ROLE_MODULE_PERMISSION;
        $role = $this->roleRepo->getFirstWhere(params: ['id' => $id, 'vendor_id' => $vendorId]);
        return view(VendorRolePaths::UPDATE[VIEW], compact('role', 'vendorRolePermissions'));
    }

    public function update(VendorRoleRequest $request): RedirectResponse
    {
        $vendorId = auth('seller')->id();
        $role = $this->roleRepo->getFirstWhere(params: ['id' => $request['id'], 'vendor_id' => $vendorId]);
        if (!$role) {
            ToastMagic::error(translate('access_denied'));
            return back();
        }

        $data = [
            'name'          => $request['name'],
            'module_access' => json_encode($request['modules']),
            'updated_at'    => now(),
        ];
        $this->roleRepo->update(id: $request['id'], data: $data);
        ToastMagic::success(translate('role_updated_successfully'));
        return back();
    }

    public function updateStatus(Request $request): JsonResponse
    {
        $vendorId = auth('seller')->id();
        $role = $this->roleRepo->getFirstWhere(params: ['id' => $request['id'], 'vendor_id' => $vendorId]);

        if (!$role) {
            return response()->json(['success' => 0, 'message' => translate('role_not_found')], 404);
        }

        $this->roleRepo->update(id: $request['id'], data: ['status' => $request->get('status', 0)]);
        return response()->json([
            'success' => 1,
            'message' => translate('status_updated_successfully'),
        ]);
    }

    /**
     * Delete a role and all its associated employees (cascade delete with image cleanup).
     */
    public function delete(Request $request): JsonResponse
    {
        try {
            $vendorId = auth('seller')->id();
            $roleId = $request->input('id');

            $role = $this->roleRepo->getFirstWhere(['id' => $roleId, 'vendor_id' => $vendorId]);
            if (!$role) {
                return response()->json(['success' => 0, 'message' => translate('role_not_found')], 404);
            }

            // Get all employees under this role
            $employees = $this->employeeRepo->getListWhere(
                filters: ['vendor_role_id' => $roleId, 'vendor_id' => $vendorId],
                dataLimit: 'all'
            );

            // Delete each employee and their images
            foreach ($employees as $employee) {
                // Delete profile image
                if ($employee->image) {
                    Storage::disk('public')->delete($employee->image);
                }
                // Delete identity images
                $identityImages = json_decode($employee->identify_image, true) ?? [];
                foreach ($identityImages as $img) {
                    Storage::disk('public')->delete($img);
                }
                // Delete employee record (include vendor_id to be safe)
                $this->employeeRepo->delete(params: ['id' => $employee->id, 'vendor_id' => $vendorId]);
            }

            // Delete the role
            $this->roleRepo->delete(params: ['id' => $roleId, 'vendor_id' => $vendorId]);

            return response()->json([
                'success' => 1,
                'message' => translate('role_and_associated_employees_deleted_successfully'),
            ]);
        } catch (\Exception $e) {
            Log::error('Role delete error: ' . $e->getMessage());
            return response()->json([
                'success' => 0,
                'message' => translate('something_went_wrong'),
            ], 500);
        }
    }
}