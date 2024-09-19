<?php

namespace App\Http\Resources\v1\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // $collection = [];
        // for ($i = 0; $i < count($this->gallery->original); $i++) {
        //     $collection[] = [
        //         "id" => $i + 1,
        //         "thumbnail" => $this->gallery->original[$i],
        //         "original" => $this->gallery->original[$i],
        //     ];
        // }

        return [
            'id' => $this->sku,
            'name' => $this->name,
            'description' => $this->description,
            'price' => floatval($this->price),
            'sell_price' => floatval($this->sell_price),
            'slug' => $this->slug,
            'stock' => intval($this->stock),
            'image' => $this->image,
            // 'gallery' => $collection,
            'variations' => VariationResource::collection($this->variation),
            //'company' => $this->company->id  ==  1 ? '' : $this->company->name,
        ];
    }
}
