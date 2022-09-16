<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'products' => ProductResource::collection($this->products),
            'shipping_data' => $this->shipping_data,
            'payed' => $this->payed,
            'sum' => $this->sum,
            'created_at' => $this->created_at->format('d-m-y'),
        ];
    }
}
