<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ShopResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request): array
    {
        $last_update = $this->updated_at;

        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'domain_id' => $this->domain_id,
            'domain' => $this->getFullDomain(),
            'options' => $this->options,
            'categories' => CategoryResource::collection($this->categories),
            'last_update' => $last_update,
            'products' => ProductResource::collection($this->products),
            'clients' => ClientResource::collection($this->clients),
            'modules_ids' => $this->modules->pluck('id'),
            'modules' => ModuleResource::collection($this->modules),
            'layout' => LayoutOptionResource::collection($this->layoutOptions),
            'colors' => ColorResource::collection($this->colors),
            'social_networks' => SocialNetworkResource::collection($this->socialNetworks),
            'banners' => BannerResource::collection($this->banners),
            'custom_pages' => CustomPageResource::collection($this->customPages),
            'reviews' => ReviewResource::collection($this->reviews),
        ];
    }
}
