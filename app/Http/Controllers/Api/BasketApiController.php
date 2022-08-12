<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BasketItemResource;
use App\Models\Basket;
use App\Models\BasketItem;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class BasketApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Shop $shop)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param BasketItem $basketItem
     * @return AnonymousResourceCollection
     */
    public function show($shop_id, Basket $basket)
    {
        return BasketItemResource::collection($basket->items);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $shop_id
     * @param Basket $basket
     * @return JsonResponse
     */
    public function update($shop_id, Basket $basket, Request $request)
    {

        $basket->items()->delete();

        foreach ($request->all() as $product) {
            $basketItem = BasketItem::create([
                'basket_id' => $basket->id,
                'product_id' => $product['product']['id']
            ]);
            $basket->items()->save($basketItem);
        }

        return response()->json($basket->items);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param BasketItem $basketItem
     * @return JsonResponse
     */
    public function destroy(BasketItem $basketItem): JsonResponse
    {
        $basketItem->delete();

        return response()->json(['status' => 'success']);
    }
}
