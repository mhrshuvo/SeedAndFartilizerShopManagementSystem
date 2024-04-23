<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_name',
        'size',
        'color',
        'price',
        'qty'

    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }
}
