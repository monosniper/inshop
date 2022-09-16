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
            'discount' => $this->discount,
            'discount_price' => $this->getDiscountPrice(),
            'inStock' => $this->inStock,
            'priority' => $this->priority,
            'properties' => $this->properties,
            'images' => $this->getImages(),
            'images_names' => $this->getImagesNames(),
            'preview_url' => $this->getPreviewUrl(),
            'description' => $this->description,
            'category_id' => $this->category_id,
            'category' => $this->category() ? $this->category()->title: '',
            'created_at' => $this->created_at,
        ];
    }
}
