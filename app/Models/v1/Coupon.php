<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $coupon_code)
 */
class Coupon extends Model
{
    use HasFactory;

    protected $fillable = [
        'coupon_code',
        'min_spend',
        'expired_at',
        'discount_percent',
        'discount',
        'discount_limit',
        'used',
        'type',
        "t_and_c",
        'status',
        'owned_by',
        'used_by'

    ];


}
