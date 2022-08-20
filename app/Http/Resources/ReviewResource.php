<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $this->date->setLocale('ru');
        return [
            'id' => $this->id,
            'author_name' => $this->author_name,
            'author_url' => $this->author_url,
            'content' => $this->content,
            'rating' => $this->rating,
            'date' => $this->date->format('y-m-d'),
            'date_diff' => $this->date->diffForHumans(),
        ];
    }
}
