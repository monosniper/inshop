<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreShopFilterRequest;
use App\Http\Resources\ShopFilterResource;
use App\Models\Shop;
use App\Models\ShopFilter;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ShopFilterApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return Admin::getCollection(ShopFilter::query(), ['title', 'slug'], $request, ShopFilterResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShopFilterRequest $request
     * @return JsonResponse
     */
    public function store(StoreShopFilterRequest $request): JsonResponse
    {
        $option = ShopFilter::create($request->validated());
        return response()->json(new ShopFilterResource($option));
    }

    /**
     * Display the specified resource.
     *
     * @param ShopFilter $filter
     * @return JsonResponse
     */
    public function show(ShopFilter $filter): JsonResponse
    {
        return response()->json(new ShopFilterResource($filter));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shop $shop
     * @param Request $request
     * @param ShopFilter $filter
     * @return JsonResponse
     */
    public function update(Shop $shop, Request $request, ShopFilter $filter): JsonResponse
    {
        $filter->update([
            'title' => $request->title,
            'slug' => $request->slug,
        ]);

        return response()->json(new ShopFilterResource($filter));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param ShopFilter $filter
     * @return JsonResponse
     */
    public function destroy(ShopFilter $filter): JsonResponse
    {
        $filter->delete();

        return response()->json(new ShopFilterResource($filter));
    }

    public function shopFilters(Shop $shop): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {
        return ShopFilterResource::collection($shop->filters);
    }

    public function activate(Shop $shop, $filter_id): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $shop->filters()->updateExistingPivot($filter_id, ['isActive' => true]);
        $shop->touch('updated_at');

        return response([
            'result' => 'success',
        ], 200);
    }

    public function deactivate(Shop $shop, $filter_id): \Illuminate\Http\Response|\Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\Routing\ResponseFactory
    {
        $shop->filters()->updateExistingPivot($filter_id, ['isActive' => false]);
        $shop->touch('updated_at');

        return response([
            'result' => 'success',
        ], 200);
    }
}
