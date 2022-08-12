<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLayoutOptionRequest;
use App\Http\Resources\LayoutOptionResource;
use App\Http\Resources\ModuleResource;
use App\Http\Services\AdminHelper;
use App\Models\LayoutOption;
use App\Models\Module;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LayoutOptionApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return AdminHelper::getCollection(LayoutOption::query(), ['name', 'slug', 'description'], $request, LayoutOptionResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreLayoutOptionRequest $request
     * @return JsonResponse
     */
    public function store(StoreLayoutOptionRequest $request): JsonResponse
    {
        $module = LayoutOption::create($request->validated());
        return response()->json(new LayoutOptionResource($module));
    }

    /**
     * Display the specified resource.
     *
     * @param LayoutOption $layoutOption
     * @return JsonResponse
     */
    public function show(LayoutOption $layoutOption): JsonResponse
    {
        return response()->json(new LayoutOptionResource($layoutOption));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreLayoutOptionRequest $request
     * @param LayoutOption $layoutOption
     * @return JsonResponse
     */
    public function update(StoreLayoutOptionRequest $request, LayoutOption $layoutOption): JsonResponse
    {
        $layoutOption = $layoutOption->update($request->only(['key', 'value']));

        return response()->json(new LayoutOptionResource($layoutOption));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param LayoutOption $layoutOption
     * @return JsonResponse
     */
    public function destroy(LayoutOption $layoutOption): JsonResponse
    {
        $layoutOption->delete();

        return response()->json(new LayoutOptionResource($layoutOption));
    }

    public function shopLayoutOptions(Shop $shop) {
        return LayoutOptionResource::collection($shop->layoutOptions);
    }

    public function activate(Shop $shop, $layout_option_id) {
        $shop->layoutOptions()->updateExistingPivot($layout_option_id, ['isActive' => true]);

        return response([
            'result' => 'success',
        ], 200);
    }

    public function deactivate(Shop $shop, $layout_option_id) {
        $shop->layoutOptions()->updateExistingPivot($layout_option_id, ['isActive' => false]);

        return response([
            'result' => 'success',
        ], 200);
    }
}
