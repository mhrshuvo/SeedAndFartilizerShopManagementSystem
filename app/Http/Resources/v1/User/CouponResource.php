<?php

namespace App\Http\Resources\v1\User;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CouponResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "coupon_code" => $this->coupon_code,
            "discount_percent" => intval( $this->discount_percent ),
            "discount" => intval($this->discount),
            "type" => $this->type,

        ];
    }
}
