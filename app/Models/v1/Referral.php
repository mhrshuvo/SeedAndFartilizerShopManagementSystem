<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $id)
 */
class Referral extends Model
{
    use HasFactory;
    protected $fillable = [
        'referral_code',
        'referrer',
        'used',
        'max',
        'referral_bonus',
    ];
}
