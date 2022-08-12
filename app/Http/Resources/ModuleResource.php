<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModuleResource extends JsonResource
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
            'slug' => $this->slug,
            'title' => $this->title,
            'description' => $this->description,
            'price' => $this->price,
            'isActive' => $this->pivot ? $this->pivot->isActive : false,
            'revertDependencies' => $this->revertDependencies(),
            'dependencies' => ModuleResource::collection($this->dependencies),
            'dependencies_ids' => $this->dependencies->pluck('id'),
        ];
    }
}
