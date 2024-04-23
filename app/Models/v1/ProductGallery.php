<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductGallery extends Model
{
    use HasFactory;
    protected $fillable = [
        'original',
        // 'thumbnail'
    ];
    protected $hidden = [
        'product_sku',
        'created_at',
        'updated_at'
    ];
    protected $casts = [
        'original' => 'array'
    ];

}
