<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MovementResource extends JsonResource
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
            'type' => $this->type,
            'quantity' => $this->quantity,
            'amount' => $this->amount,
            'total' => $this->total,
            'cash_register_detail_id' => $this->cash_register_detail_id,
            'product_id' => $this->product_id,
            'user_id' => $this->user_id,
        ];
    }
}
