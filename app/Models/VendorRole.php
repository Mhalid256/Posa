<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property int    $vendor_id
 * @property string $name
 * @property string $module_access   JSON
 * @property bool   $status
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class VendorRole extends Model
{
    protected $fillable = [
        'vendor_id',
        'name',
        'module_access',
        'status',
    ];

    protected $casts = [
        'id'         => 'integer',
        'vendor_id'  => 'integer',
        'name'       => 'string',
        'status'     => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /* ------------------------------------------------------------------ */
    /*  Relationships                                                       */
    /* ------------------------------------------------------------------ */

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'vendor_id');
    }

    public function employees(): HasMany
    {
        return $this->hasMany(VendorEmployee::class, 'vendor_role_id');
    }
}
