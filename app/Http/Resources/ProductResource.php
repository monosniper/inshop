<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
            'uuid' => $this->uuid,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'price' => $this->price,
            'inStock' => $this->inStock,
            'properties' => $this->properties,
            'images' => $this->getImages(),
            'preview_url' => $this->getPreviewUrl(),
            'description' => $this->description,
            'category_id' => $this->category_id,
            'created_at' => $this->created_at,
        ];
    }
}
