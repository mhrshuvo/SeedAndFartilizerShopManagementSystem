<?php

namespace App\Http\Resources\v1\Product;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Str;

class ColourResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->value,
            'slug' => Str::lower(Str::slug($this->value, '-')),
            'hexColor' => $this->meta
        ];
    }
}
