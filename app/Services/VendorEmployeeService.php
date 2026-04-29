<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VendorEmployeeService
{
    /**
     * Process and store the employee profile image.
     * Uses Laravel Storage API for consistency.
     */
    public function uploadImage($file, string $directory = 'vendor/employee'): ?string
    {
        if (!$file) {
            return null;
        }
        $path = $file->store($directory, 'public');
        return $path;
    }

    /**
     * Delete an image from storage.
     */
    public function deleteImage(?string $path): void
    {
        if ($path && Storage::disk('public')->exists($path)) {
            Storage::disk('public')->delete($path);
        }
    }

    /**
     * Process multiple identity images.
     * Returns JSON-encoded array of stored paths.
     */
    public function uploadMultipleImages(array $files, string $directory = 'vendor/employee/identity'): array
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->uploadImage($file, $directory);
        }
        return $paths;
    }

    /**
     * Build the employee data array for create/update.
     *
     * @param Request $request
     * @param \App\Models\VendorEmployee|null $existingEmployee
     * @return array
     */
    public function buildEmployeeData($request, $existingEmployee = null): array
    {
        $data = [
            'name'            => $request->input('name'),
            'phone'           => $request->input('phone'),
            'email'           => $request->input('email'),
            'vendor_role_id'  => $request->input('vendor_role_id'),
            'identify_type'   => $request->input('identify_type'),
            'identify_number' => $request->input('identify_number'),
            'updated_at'      => now(),
        ];

        // Only set password if a new one is provided
        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->input('password'));
        }

        // Profile image
        if ($request->hasFile('image')) {
            $oldImage = $existingEmployee ? $existingEmployee->image : null;
            if ($oldImage) {
                $this->deleteImage($oldImage);
            }
            $data['image'] = $this->uploadImage($request->file('image'), 'vendor/employee');
        } elseif ($existingEmployee && $existingEmployee->image) {
            $data['image'] = $existingEmployee->image;
        }

        // Identity images (replace all on upload)
        if ($request->hasFile('identity_image')) {
            $oldIdentityImages = $existingEmployee ? json_decode($existingEmployee->identify_image, true) ?? [] : [];
            foreach ($oldIdentityImages as $oldImg) {
                $this->deleteImage($oldImg);
            }
            $identityPaths = $this->uploadMultipleImages($request->file('identity_image'), 'vendor/employee/identity');
            $data['identify_image'] = json_encode($identityPaths);
        } elseif ($existingEmployee && $existingEmployee->identify_image) {
            $data['identify_image'] = $existingEmployee->identify_image;
        }

        return $data;
    }
}