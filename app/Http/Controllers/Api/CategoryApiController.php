<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Shop $shop)
    {
        return CategoryResource::collection($shop->categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return CategoryResource
     */
    public function store($shop_id, Request $request)
    {
        $category = Category::create([
            'title' => $request->title,
            'shop_id' => $shop_id,
            'uuid' => $request->uuid,
        ]);

        return new CategoryResource($category);
    }

    /**
     * Display the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Category $category
     * @return JsonResponse
     */
    public function update($shop_id, Request $request, Category $category): JsonResponse
    {
        $category->update($request->only(['title']));

        return response()->json(new CategoryResource($category));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $shop_id
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy($shop_id, Category $category): JsonResponse
    {
        $category->delete();

        return response()->json(new CategoryResource($category));
    }

    public function deleteMany(Shop $shop, Request $request) {
        return Category::whereIn('id', $request->ids)->delete();
    }
}
