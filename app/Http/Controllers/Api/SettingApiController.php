<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\SettingResource;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        return Admin::getCollection(Setting::query(), ['name', 'key'], $request, SettingResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $setting = Setting::create($request->only(['key', 'value', 'name', 'isRich']));

        return response()->json(new SettingResource($setting));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Setting $setting)
    {
        return response()->json(new SettingResource($setting));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Setting $setting)
    {
        $setting = $setting->update($request->only(['key', 'value', 'name', 'isRich']));

        return response()->json(new SettingResource($setting));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Setting $setting)
    {
        $setting->delete();

        return response()->json(new SettingResource($setting));
    }
}
