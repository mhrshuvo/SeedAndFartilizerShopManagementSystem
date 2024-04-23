<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductVariation extends Model
{
    use HasFactory;
    protected $fillable = [
        'value',
        'meta',
        'attribute',
        'quantity',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];


    public function product()
    {
        return $this->belongsToMany(product::class, 'product_variation', 'variation_id', 'product_id')->withPivot('quantity');
    }
}
