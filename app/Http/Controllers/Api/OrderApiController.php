<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Resources\ColorResource;
use App\Http\Resources\OrderResource;
use App\Models\Color;
use App\Models\Order;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class OrderApiController extends Controller
{
    public function qiwiPayCallback(Request $request) {
        info('Qiwi Callback: ');
        info($request->all());
    }

    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Shop $shop)
    {
        return OrderResource::collection($shop->orders()->withSum('products as sum', 'price')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $shop_id
     * @param Request $request
     * @return int
     */
    public function store($shop_id, Request $request): int
    {
        $order = Order::create([
            'shop_id' => $shop_id,
            'shipping_data' => $request->shipping_data,
            'billId' => $request->billId
        ]);

        $order->products()->sync($request->products);

        return $order->id;
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function show(int $id): Response
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Order $order
     * @return JsonResponse
     */
    public function destroy(Shop $shop, Order $order): JsonResponse
    {
        $order->delete();

        return response()->json(new OrderResource($order));
    }

    public function deleteMany(Shop $shop, Request $request) {
        return Order::whereIn('id', $request->ids)->delete();
    }
}
