<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Resources\BannerResource;
use App\Models\Banner;
use App\Models\Basket;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BannerApiController extends Controller
{
    public function getTypes() {
        return response()->json([
            'data' => Banner::TYPES
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Shop $shop
     * @return JsonResponse
     */
    public function index(Shop $shop): JsonResponse
    {
        return response()->json(BannerResource::collection($shop->banners));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreBannerRequest $request
     * @return JsonResponse
     */
    public function store($shop_id, Request $request): JsonResponse
    {
        $banner = Banner::create($request->only(['order', 'uuid']) + ['shop_id' => $shop_id]);
        return response()->json(new BannerResource($banner));
    }

    /**
     * Display the specified resource.
     *
     * @param Basket $basket
     * @return \Illuminate\Http\Response
     */
    public function show(Basket $basket)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Banner $banner
     * @return JsonResponse
     */
    public function update(Shop $shop, StoreBannerRequest $request, Banner $banner): JsonResponse
    {
        $banner->update($request->validated());

        return response()->json(new BannerResource($banner));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Banner $banner
     * @return JsonResponse
     */
    public function destroy(Shop $shop, Banner $banner): JsonResponse
    {
        $banner->delete();

        return response()->json(new BannerResource($banner));
    }
}
