<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ModuleResource;
use App\Http\Resources\ProductResource;
use App\Models\Basket;
use App\Models\Client;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ClientApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Shop $shop)
    {
        return ClientResource::collection($shop->clients);
    }

    public function shopClients(Shop $shop) {
        return ClientResource::collection($shop->clients);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
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
     * @param Shop $shop
     * @param Client $client
     * @return JsonResponse
     */
    public function destroy(Shop $shop, Client $client): JsonResponse
    {
        $client->delete();

        return response()->json(new ClientResource($client));
    }

    public function deleteMany(Shop $shop, Request $request) {
        return Client::whereIn('id', $request->ids)->delete();
    }
}
