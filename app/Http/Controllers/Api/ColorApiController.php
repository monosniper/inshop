<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreColorRequest;
use App\Http\Resources\ColorResource;
use App\Models\Color;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ColorApiController extends Controller
{
    public function shopColors(Shop $shop): JsonResponse
    {
        return response()->json(ColorResource::collection($shop->colors));
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return Admin::getCollection(Color::query(), ['name', 'slug', 'description', 'default_value'], $request, ColorResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreColorRequest $request
     * @return JsonResponse
     */
    public function store(StoreColorRequest $request): JsonResponse
    {
        $color = Color::create($request->validated());
        return response()->json(new ColorResource($color));
    }

    /**
     * Display the specified resource.
     *
     * @param Color $color
     * @return JsonResponse
     */
    public function show(Color $color): JsonResponse
    {
        return response()->json(new ColorResource($color));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shop $shop
     * @param StoreColorRequest $request
     * @param Color $color
     * @return JsonResponse
     */
    public function update(Shop $shop, Request $request, Color $color): JsonResponse
    {
        $color->update($request->all());

        return response()->json(new ColorResource($color));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shop $shop
     * @param StoreColorRequest $request
     * @param Color $color
     * @return JsonResponse
     */
    public function save(Shop $shop, Request $request, Color $color): JsonResponse
    {
        $shop->colors()->updateExistingPivot($color->id, [
            'value' => $request->value
        ]);

        return response()->json(new ColorResource($color));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Color $color
     * @return JsonResponse
     */
    public function destroy(Color $color): JsonResponse
    {
        $color->delete();

        return response()->json(new ColorResource($color));
    }

    public function reset(Shop $shop, Color $color) {
        $shop->colors()->updateExistingPivot($color->id, ['value' => $color->default_value]);
        return response()->json(new ColorResource($color));
    }
}
