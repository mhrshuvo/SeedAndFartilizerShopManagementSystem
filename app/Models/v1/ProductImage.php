<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    protected $fillable = [
        'original',
        'thumbnail'
    ];
    protected $hidden = [
        'product_sku',
        'created_at',
        'updated_at'
    ];
}
