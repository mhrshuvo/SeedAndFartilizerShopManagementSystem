<?php

namespace App\Http\Resources\v1\Order;

use App\Models\v1\District;
use App\Models\v1\Division;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
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
            'bkash_url' => $this->bkash_url,
            'tracking_id'=>$this->tracking_id,
            'contact_no'=>$this->contact_no,
            'district' => District::where('id',$this->district_id)->get('name')->implode('name',''),
            'division' => Division::where('id',$this->division_id)->get('name')->implode('name',''),
            'address'=>$this->address,
            'delivery_charge'=>floatval($this->delivery_charge),
            'vat'=>floatval($this->vat),
            'sub_total' =>floatval($this->sub_total),
            'coupon_discount' => floatval($this->coupon_discount),
            'total_price' => floatval($this->total_price),
            'note' => $this->note,
            'created_at' => $this->created_at,
            'status' => $this->status,
            'order_products' => OrderProductResource::collection($this->order_products)
        ];
    }
}
