<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BannerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'order' => $this->order,
            'type' => $this->type,
            'title' => $this->title,
            'text' => $this->text,
            'color' => $this->color,
            'background' => $this->background,
            'button_text' => $this->button_text,
            'button_link' => $this->button_link,
            'button_background' => $this->button_background,
            'button_color' => $this->button_color,
            'image_url' => $this->getImage(),
            'image_name' => $this->getImageName(),
            'uuid' => $this->uuid,
        ];
    }
}
