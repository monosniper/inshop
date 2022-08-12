<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
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
            'basket_id' => $this->getBasketId(),
            'email' => $this->email,
            'fio' => $this->fio,
            'phone' => $this->phone,
            'address' => $this->address,
        ];
    }
}
