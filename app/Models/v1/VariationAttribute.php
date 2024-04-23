<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariationAttribute extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
    ];
    protected $hidden = [
        'product_variation_id',
        'created_at',
        'updated_at',
    ];

  
}
