<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginClientRequest;
use App\Http\Requests\RegisterClientRequest;
use App\Http\Requests\StoreShopRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\SettingResource;
use App\Http\Resources\ShopResource;
use App\Http\Services\AdminHelper;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Setting;
use App\Models\Shop;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use JetBrains\PhpStorm\Pure;

class ShopApiController extends Controller
{

    /**
     * @throws ValidationException
     */
    public function getClientToken($shop_id, Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $client = Client::where([['shop_id', $shop_id], ['email', $request->email]])->first();

        if (! $client || ! Hash::check($request->password, $client->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        return $client->createToken($request->email)->plainTextToken;
    }

    public function getShop(Request $request) {
        $domain = Domain::where('name', $request->domain_name)->first();

        if(!$domain) return response(['result' => 'error', 'message' => 'Доменное имя не найдено.'], 400);

        $shop = Shop::findByDomain($domain->id);

        if(!$shop) return response(['result' => 'error', 'message' => 'Не найдено магазина с таким доменным именем.'],400);

        return new ShopResource($shop);
    }

    public function registerClient($shop_id, RegisterClientRequest $request) {

        $exists = Client::where([['shop_id', $shop_id], ['email', $request->email]])->exists();

        if ($exists) {
            throw ValidationException::withMessages([
                'email' => ['User with this email already exists.'],
            ]);
        }

        $client = Client::create([
            'shop_id' => $shop_id,
            'email' => $request['email'],
            'fio' => $request['fio'],
            'password' => Hash::make($request['password']),
        ]);

        return response()->json(new ClientResource($client), 200);
    }

    public function loginClient($shop_id, LoginClientRequest $request) {
        if(auth()->guard('client')->attempt([...$request->validated(), 'shop_id' => $shop_id])){
            $client = Client::find(auth()->guard('client')->user()->id);

            return response()->json(new ClientResource($client), 200);
        }else{
            return response()->json(['message' => ['Email and Password are Wrong.']], 401);
        }
    }

    public function refreshClient(Request $request) {
        return $request->user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return AdminHelper::getCollection(
            Shop::query(),
            ['options->title'],
            $request,
            ShopResource::class,
            ['options.title' => 'options->title']
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreShopRequest $request
     * @return JsonResponse|Application|Response|ResponseFactory
     */
    public function store(StoreShopRequest $request): JsonResponse|Application|Response|ResponseFactory
    {
        try {
            $shop = Shop::create([
                'user_id' => $request->user_id,
                'options' => $request->options,
                'domain_id' => $request->domain_id
            ]);
        } catch(\Exception $err) {
            return response(['result' => 'error', 'message' => 'Магазин с этим доменом уже существует.', 'details' => $err], 400);
        }
        if(array_key_exists('modules', $request->options)) {
            $shop->modules()->sync($request->options['modules']);
        }

        return response()->json(new ShopResource($shop));
    }

    /**
     * Display the specified resource.
     *
     * @param Shop $shop
     * @return JsonResponse
     */
    public function show(Shop $shop): JsonResponse
    {
        return response()->json(new ShopResource($shop));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Shop $shop
     * @return JsonResponse
     */
    public function update(Request $request, Shop $shop): JsonResponse
    {
        $shop->update(['options' => json_encode($request->all())]);

        return response()->json(new ShopResource($shop));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shop $shop
     * @return JsonResponse
     */
    public function destroy(Shop $shop): JsonResponse
    {
        $shop->delete();

        return response()->json(new ShopResource($shop));
    }
}
