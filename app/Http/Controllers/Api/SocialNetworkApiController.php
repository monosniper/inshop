<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorRequest;
use App\Http\Resources\SocialNetworkResource;
use App\Models\Shop;
use App\Models\SocialNetwork;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SocialNetworkApiController extends Controller
{
    public function shopSocialNetworks(Shop $shop): JsonResponse
    {
        return response()->json(SocialNetworkResource::collection($shop->socialNetworks));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return Admin::getCollection(SocialNetwork::query(), ['slug'], $request, SocialNetworkResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $social_network = SocialNetwork::create($request->only(['slug']));
        return response()->json(new SocialNetworkResource($social_network));
    }

    /**
     * Display the specified resource.
     *
     * @param SocialNetwork $socialNetwork
     * @return JsonResponse
     */
    public function show(SocialNetwork $socialNetwork): JsonResponse
    {
        return response()->json(new SocialNetworkResource($socialNetwork));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param SocialNetwork $socialNetwork
     * @return JsonResponse
     */
    public function update(Request $request, SocialNetwork $socialNetwork): JsonResponse
    {
        $socialNetwork->update($request->all());

        return response()->json(new SocialNetworkResource($socialNetwork));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shop $shop
     * @param StoreColorRequest $request
     * @param SocialNetwork $socialNetwork
     * @return JsonResponse
     */
    public function save(Shop $shop, Request $request, SocialNetwork $socialNetwork): JsonResponse
    {
        $shop->socialNetworks()->updateExistingPivot($socialNetwork->id, [
            'value' => $request->value
        ]);

        return response()->json(new SocialNetworkResource($socialNetwork));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SocialNetwork $socialNetwork
     * @return JsonResponse
     */
    public function destroy(SocialNetwork $socialNetwork): JsonResponse
    {
        $socialNetwork->delete();

        return response()->json(new SocialNetworkResource($socialNetwork));
    }
}
