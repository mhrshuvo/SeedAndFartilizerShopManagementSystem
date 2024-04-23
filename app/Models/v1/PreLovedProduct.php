<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreLovedProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'pre_loved_id',
        'product_name',
        'buy_price',
        'buy_date',
        'used_status',
        'condition',
        'sell_price',
        'weight'
    ];
}
