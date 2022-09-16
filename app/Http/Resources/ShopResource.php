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

        $resources = [
            'categories'         => CategoryResource::collection($this->categories),
//            'products'           => ProductResource::collection($this->products()->orderBy('order', 'desc')->get()),
            'products'           => ProductResource::collection($this->products),
            'clients'            => ClientResource::collection($this->clients),
            'modules'            => ModuleResource::collection($this->modules),
            'layout'             => LayoutOptionResource::collection($this->layoutOptions),
            'filters'            => ShopFilterResource::collection($this->filters),
            'colors'             => ColorResource::collection($this->colors),
            'social_networks'    => SocialNetworkResource::collection($this->socialNetworks),
            'banners'            => BannerResource::collection($this->banners),
            'custom_pages'       => CustomPageResource::collection($this->customPages),
            'reviews'            => ReviewResource::collection($this->reviews),
            'orders'             => OrderResource::collection(
                                        $this->orders()->withSum('products as sum', 'price')->get()
                                    ),
        ];

        $array = [
            'uuid'               => $this->uuid,
            'id'                 => $this->id,
            'logo_url'           => $this->getLogoUrl(),
            'logo_name'          => $this->getLogoName(),
            'user_id'            => $this->user_id,
            'domain_id'          => $this->domain_id,
            'domain'             => $this->domain->getFullDomain(),
            'options'            => $this->options,
            'modules_ids'        => $this->modules->pluck('id'),
            'last_update'        => $last_update,

            ...$resources
        ];

        return $array;
    }
}
