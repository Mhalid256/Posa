<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int    $id
 * @property int    $vendor_id
 * @property int    $subscription_id
 * @property float  $amount
 * @property string $payment_method
 * @property string $transaction_ref
 * @property string $pesapal_order_id
 * @property string $pesapal_tracking_id
 * @property string $status             pending|completed|failed
 * @property Carbon $paid_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class VendorSubscriptionPayment extends Model
{
    protected $fillable = [
        'vendor_id',
        'subscription_id',
        'amount',
        'payment_method',
        'transaction_ref',
        'pesapal_order_id',
        'pesapal_tracking_id',
        'status',
        'paid_at',
    ];

    protected $casts = [
        'vendor_id'       => 'integer',
        'subscription_id' => 'integer',
        'amount'          => 'float',
        'paid_at'         => 'datetime',
        'created_at'      => 'datetime',
        'updated_at'      => 'datetime',
    ];

    public function vendor(): BelongsTo
    {
        return $this->belongsTo(Seller::class, 'vendor_id');
    }

    public function subscription(): BelongsTo
    {
        return $this->belongsTo(VendorSubscription::class, 'subscription_id');
    }
}
