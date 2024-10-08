<?php

namespace App\Http\Resources\v1\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductListResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->sku,
            'name' => $this->name,
            'price' => floatval( $this->price),
            'sell_price' => floatval($this->sell_price),
            'stock' => $this->stock,
            'slug' => $this->slug,
            'image'=> [
                'thumbnail' => $this->thumbnail,
                'original' => $this->thumbnail,
            ],
        ];
    }
}
