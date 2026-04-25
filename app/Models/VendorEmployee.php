<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int    $id
 * @property int    $vendor_id
 * @property int    $vendor_role_id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $password
 * @property string $image
 * @property string $identify_type
 * @property string $identify_number
 * @property string $identify_image   JSON
 * @property bool   $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class VendorEmployee extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'vendor_id',
        'vendor_role_id',
        'name',
        'email',
        'phone',
        'password',
        'image',
        'identify_type',
        'identify_number',
        'identify_image',
        'status',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected $casts = [
        'id'             => 'integer',
        'vendor_id'      => 'integer',
        'vendor_role_id' => 'integer',
        'status'         => 'boolean',
        'created_at'     => 'datetime',
        'updated_at'     => 'datetime',
    ];

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                       */
    /* ------------------------------------------------------------------ */

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'vendor_id');
    }

    public function role(): BelongsTo
    {
        return $this->belongsTo(VendorRole::class, 'vendor_role_id');
    }

    /* ------------------------------------------------------------------ */
    /*  Helpers                                                             */
    /* ------------------------------------------------------------------ */

    /**
     * Returns decoded identify images array, or empty array.
     */
    public function getIdentifyImagesAttribute(): array
    {
        return $this->identify_image ? json_decode($this->identify_image, true) : [];
    }

    /**
     * Decoded module_access from the attached role.
     */
    public function getModuleAccessAttribute(): array
    {
        if (!$this->role) {
            return [];
        }
        return json_decode($this->role->module_access, true) ?? [];
    }

    /**
     * Check if the employee has access to a given module key.
     */
    public function hasModuleAccess(string $module): bool
    {
        return in_array($module, $this->module_access);
    }
}
