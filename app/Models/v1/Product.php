<?php

namespace App\Models\v1;

use App\Models\User;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static where(string $string, mixed $product_id)
 * @method static latest()
 * @method static create(mixed $input)
 */
class Product extends Model
{
    use HasFactory;

    // protected $primaryKey = 'sku';

    public function getRouteKeyName()
    {
        return 'sku';
    }
    protected $fillable = [
        'sku',
        'name',
        'description',
        'price',
        'sell_price',
        'slug',
        'stock',
        'active',
        'user_id',
       // 'serial'

    ];
    protected $hidden = [
        'id',
    ];

    protected static function boot() {
        parent::boot();


        // static::creating(function ($product) {

        //     if (empty($product->sku)) {
        //         $product->sku = substr(Str::uuid(), 4, 8) . Carbon::now()->format('s');
        //     }
        // });
    }

    public static function generateSKU(){
        return substr(Str::uuid(), 4, 8) . Carbon::now()->format('s');
    }

    public function image()
    {
        return $this->hasOne(ProductImage::class, 'product_sku', 'sku');
    }
    public function gallery()
    {
        return $this->hasOne(ProductGallery::class, 'product_sku', 'sku');
    }
    public function variation()
    {
        return $this->belongsToMany(ProductVariation::class, 'product_variation', 'product_id', 'variation_id')->withPivot('quantity');
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_product', 'product_id', 'category_id')->where('is_active', 1);
    }
    public function company()
    {
        return $this->belongsTo(User::class ,'user_id', 'id');
    }

}
