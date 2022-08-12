<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeedBackResource extends JsonResource
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
            'theme' => $this->theme,
            'email' => $this->email,
            'content' => $this->content,
            'answer' => $this->answer,
            'created_at' => $this->created_at,
            'answered_at' => $this->answered_at,
        ];
    }
}
