<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCustomPageRequest;
use App\Http\Requests\UpdateCustomPageRequest;
use App\Http\Resources\CustomPageResource;
use App\Http\Resources\ModuleResource;
use App\Models\CustomPage;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class CustomPageApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Shop $shop
     * @return AnonymousResourceCollection
     */
    public function index(Shop $shop): AnonymousResourceCollection
    {
        return CustomPageResource::collection($shop->customPages);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreCustomPageRequest $request
     * @return JsonResponse
     */
    public function store($shop_id, StoreCustomPageRequest $request): JsonResponse
    {
        $module = CustomPage::create($request->validated() + ['shop_id' => $shop_id]);

        return response()->json(new CustomPageResource($module));
    }

    /**
     * Display the specified resource.
     *
     * @param CustomPage $customPage
     * @return JsonResponse
     */
    public function show(CustomPage $customPage): JsonResponse
    {
        return response()->json(new CustomPageResource($customPage));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCustomPageRequest $request
     * @param CustomPage $customPage
     * @return JsonResponse
     */
    public function update(Shop $shop, UpdateCustomPageRequest $request, CustomPage $customPage): JsonResponse
    {
        $customPage->update($request->validated());

        return response()->json(new CustomPageResource($customPage));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shop $shop
     * @param CustomPage $customPage
     * @return JsonResponse
     */
    public function destroy(Shop $shop, CustomPage $customPage): JsonResponse
    {
        $customPage->delete();

        return response()->json(new CustomPageResource($customPage));
    }

    public function activate(Shop $shop, CustomPage $customPage): JsonResponse
    {
        $customPage->update(['isActive' => true]);

        return response()->json(new CustomPageResource($customPage));
    }

    public function deactivate(Shop $shop, CustomPage $customPage): JsonResponse
    {
        $customPage->update(['isActive' => false]);

        return response()->json(new CustomPageResource($customPage));
    }
}
