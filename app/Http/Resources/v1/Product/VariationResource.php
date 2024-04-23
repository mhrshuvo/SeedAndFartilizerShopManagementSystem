<?php

namespace App\Http\Resources\v1\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class VariationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id'=>$this->id,
            'value'=>$this->value,
            'meta'=>$this->meta,
            'attribute'=>[
                'id'=>1,
                'name'=>$this->attribute,
                'slug'=>Str::lower(Str::slug($this->attribute, '-'))
            ],

        ];
    }
}
