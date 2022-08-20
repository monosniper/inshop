<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ShopResource;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
     * @param StoreProductRequest $request
     * @return ProductResource
     */
    public function store(Shop $shop, StoreProductRequest $request): ProductResource
    {
        $limit = (int)setting('limits.products');
        $products_limit = $shop->loadCount('products')->products_count >= $limit;
        abort_if($products_limit, ResponseAlias::HTTP_BAD_REQUEST, 'Максимальное количество позиций в магазине уже достигнуто ('.$limit.').');

        $product = Product::create([
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'price' => $request->price,
            'discount' => $request->discount ?? 0,
            'inStock' => $request->inStock,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'shop_id' => $shop->id,
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
     * @param Shop $shop
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return JsonResponse
     */
    public function update(Shop $shop, UpdateProductRequest $request, Product $product): JsonResponse
    {
        $product->update($request->validated());

        return response()->json(new ProductResource($product));
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
