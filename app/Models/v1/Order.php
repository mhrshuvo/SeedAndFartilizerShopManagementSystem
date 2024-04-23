<?php

namespace App\Models\v1;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static create(array $input)
 */
class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'tracking_id',
        'user_id',
        'address',
        'contact_no',
        'sub_total',
        'coupon_code',
        'coupon_discount',
        'delivery_charge',
        'total_price',
        'note',
        'vat',
        'district_id',
        'division_id'
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function order_products():HasMany
    {
        return $this->hasMany(OrderProducts::class);
    }
    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class);
    }
    public function division(): BelongsTo
    {
        return $this->belongsTo(Division::class);
    }
}
