<?php

namespace App\Models\v1;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [

        'title',
        'slug',
        'type',
        'is_active'
    ];



    public function products()
    {
        return $this->belongsToMany(Product::class, 'category_product', 'category_id',  'product_id',);
    }

    protected static function boot() {
        parent::boot();
        static::creating(function ($category) {

            if (empty($category->slug)) {
                $category->slug = $category->type . '-' . Str::slug($category->title);
            }
        });
    }
}
