<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\SettingResource;
use App\Http\Services\AdminHelper;
use App\Models\Module;
use App\Models\Setting;
use App\Models\Shop;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\DB;

class ModuleApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return AdminHelper::getCollection(Module::query(), ['title', 'slug', 'description'], $request, ModuleResource::class);
    }

    public function shopModules(Shop $shop, Module $module): AnonymousResourceCollection
    {
        return ModuleResource::collection($shop->modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreModuleRequest $request
     * @return JsonResponse
     */
    public function store(StoreModuleRequest $request): JsonResponse
    {
        $module = Module::create($request->validated());

        $module->dependencies()->sync($request->dependencies_ids);

        return response()->json(new ModuleResource($module));
    }

    /**
     * Display the specified resource.
     *
     * @param Shop $shop
     * @param Module $module
     * @return JsonResponse
     */
    public function show(Shop $shop, Module $module): JsonResponse
    {
        return response()->json(new ModuleResource($module));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateModuleRequest $request
     * @param Shop $shop
     * @param Module $module
     * @return JsonResponse
     */
    public function update(UpdateModuleRequest $request, Shop $shop, Module $module): JsonResponse
    {
        $module->update($request->only(['key', 'value']));

        $module->dependencies()->sync($request->dependencies_ids);

        return response()->json(new ModuleResource($module));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shop $shop
     * @param Module $module
     * @return JsonResponse
     */
    public function destroy(Shop $shop, Module $module): JsonResponse
    {
        $module->delete();

        return response()->json(new ModuleResource($module));
    }

    public function getModule(Shop $shop, $module_id) {
        if($shop->hasModule($module_id)) return response([
            'result' => 'error', 'message' => 'Магазин уже имеет данный модуль.',
        ], 400);
            $shop->modules()->attach($module_id);

        return response([
            'result' => 'success',
        ], 200);
    }

    public function activate(Shop $shop, Module $module) {
        $shop->modules()->updateExistingPivot($module->id, ['isActive' => true]);

        // Активировать все модули, от которых зависит включаемый
        DB::table('module_shop')
            ->select('*')
            ->where('shop_id', $shop->id)
            ->whereIn('module_id', $module->dependencies->pluck('id'))
            ->update(['isActive' => true]);

        return response([
            'result' => 'success',
        ], 200);
    }

    public function deactivate(Shop $shop, Module $module) {
        $shop->modules()->updateExistingPivot($module->id, ['isActive' => false]);

        // Деактивировать все модули, зависящие от выключаемого
        DB::table('module_shop')
            ->select('*')
            ->where('shop_id', $shop->id)
            ->whereIn('module_id', $module->revertDependencies()->pluck('id'))
            ->update(['isActive' => false]);

        return response([
            'result' => 'success',
        ], 200);
    }
}
