<?php

namespace App\Http\Resources;

use App\Models\OrderDetail;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'order_code' => $this->order_code,
            'total_amount' => $this->total_amount,
            'order_status' => $this->order_status,
            'additional_note' => $this->additional_note,
            'created_at'  => $this->created_at,
            'userDetails' => new UserResource($this->whenLoaded('user')),
            'orderDetails' => OrderDetailResource::collection($this->whenLoaded('orderdetails')),


        ];
    }
}
