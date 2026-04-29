<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int    $id
 * @property int    $vendor_id
 * @property string $start_date
 * @property string $end_date
 * @property float  $amount_paid
 * @property string $payment_method
 * @property string $payment_reference
 * @property string $status          active|expired|grace
 * @property Carbon $reminder_sent_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class VendorSubscription extends Model
{
    protected $fillable = [
        'vendor_id',
        'start_date',
        'end_date',
        'amount_paid',
        'payment_method',
        'payment_reference',
        'status',
        'reminder_sent_at',
    ];

    protected $casts = [
        'vendor_id'        => 'integer',
        'amount_paid'      => 'float',
        'start_date'       => 'date',
        'end_date'         => 'date',
        'reminder_sent_at' => 'datetime',
        'created_at'       => 'datetime',
        'updated_at'       => 'datetime',
    ];

    /* ── Relationships ─────────────────────────────────────────── */

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'vendor_id');
    }

    public function payments(): HasMany
    {
        return $this->hasMany(VendorSubscriptionPayment::class, 'subscription_id');
    }

    /* ── Helpers ────────────────────────────────────────────────── */

    /** Days remaining until subscription expires */
    public function daysRemaining(): int
    {
        return (int) now()->startOfDay()->diffInDays(Carbon::parse($this->end_date), false);
    }

    /** True if within the 10-day reminder window */
    public function isExpiringSoon(): bool
    {
        $days = $this->daysRemaining();
        return $days >= 0 && $days <= 10;
    }

    /** True if subscription is past end_date */
    public function isExpired(): bool
    {
        return now()->startOfDay()->isAfter(Carbon::parse($this->end_date));
    }
}
