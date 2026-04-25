<?php

namespace App\Services;

use Illuminate\Http\Request;

class VendorEmployeeService
{
    /**
     * Process and store the employee profile image.
     * Follows the same pattern as AdminService::getProceedImage().
     */
    public function getProceedImage(Request $request, ?string $oldImage = null): string
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = fileUploader($image, 'vendor-employee/', 300, $oldImage);
            return $imageName;
        }
        return $oldImage ?? '';
    }

    /**
     * Process and store identity verification images (can be multiple).
     * Returns JSON-encoded array of paths.
     */
    public function getIdentityImages(Request $request, ?string $oldImages = null): string
    {
        $images = [];

        // Preserve old images if no new ones uploaded
        if ($oldImages) {
            $images = json_decode($oldImages, true) ?? [];
        }

        if ($request->hasFile('identity_image')) {
            $images = []; // Reset - replace with new uploads
            foreach ($request->file('identity_image') as $file) {
                $images[] = fileUploader($file, 'vendor-employee/identity/', 600);
            }
        }

        return json_encode($images);
    }

    /**
     * Build the employee data array for create/update.
     */
    public function buildEmployeeData(Request $request, ?array $existing = null): array
    {
        $data = [
            'name'            => $request['name'],
            'phone'           => $request['phone'],
            'email'           => $request['email'],
            'vendor_role_id'  => $request['vendor_role_id'],
            'identify_type'   => $request['identify_type'],
            'identify_number' => $request['identify_number'],
            'updated_at'      => now(),
        ];

        // Password: only update if provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request['password']);
        } elseif ($existing) {
            $data['password'] = $existing['password'];
        }

        // Profile image
        if ($request->hasFile('image')) {
            $data['image'] = $this->getProceedImage($request, $existing['image'] ?? null);
        } elseif ($existing) {
            $data['image'] = $existing['image'];
        }

        // Identity images
        if ($request->hasFile('identity_image')) {
            $data['identify_image'] = $this->getIdentityImages($request, $existing['identify_image'] ?? null);
        } elseif ($existing) {
            $data['identify_image'] = $existing['identify_image'];
        }

        return $data;
    }
}
