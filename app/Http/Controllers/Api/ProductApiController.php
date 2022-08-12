<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Shop $shop): AnonymousResourceCollection
    {
        return ProductResource::collection($shop->products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $shop_id
     * @param Request $request
     * @return ProductResource
     */
    public function store($shop_id, StoreProductRequest $request): ProductResource
    {
        $product = Product::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'price' => $request->price,
            'inStock' => $request->inStock,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'shop_id' => $shop_id,
            'properties' => json_encode([]),
            'uuid' => $request->uuid,
        ]);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Shop $shop, $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return JsonResponse
     */
    public function destroy(Shop $shop, Product $product): JsonResponse
    {
        $product->delete();

        return response()->json(new ProductResource($product));
    }

    public function deleteMany(Shop $shop, Request $request) {
        return Product::whereIn('id', $request->ids)->delete();
    }
}
