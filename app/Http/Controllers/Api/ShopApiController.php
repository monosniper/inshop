<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginClientRequest;
use App\Http\Requests\RegisterClientRequest;
use App\Http\Requests\StoreShopRequest;
use App\Http\Resources\ClientResource;
use App\Http\Resources\ShopResource;
use App\Models\Client;
use App\Models\Domain;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

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
        $domain = Domain::where('name', $request->subdomain)
            ->orWhere('name', str_replace('www.', '', $request->domain))
            ->orWhere('name', $request->domain)
            ->first();

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
        return Admin::getCollection(
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
        $exists = Shop::where('domain_id', $request->domain_id)->exists();
        abort_if($exists, ResponseAlias::HTTP_BAD_REQUEST, 'Магазин с этим доменом уже существует.');

        $user = User::findOrFail($request->user_id)->loadCount('shops');

        $limit = (int)setting('limits.shops');
        $shops_limit = $user->shops_count >= $limit;
        abort_if($shops_limit, ResponseAlias::HTTP_BAD_REQUEST, 'Максимальное количество магазинов уже достигнуто ('.$limit.').');

        $shop = Shop::create([
            'uuid' => $request->uuid,
            'user_id' => $request->user_id,
            'options' => $request->options,
            'domain_id' => $request->domain_id
        ]);

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
        $shop->update(['options' => $request->except('domain_id')]);

        if($request->domain_id) {
            $domain = Domain::findOrFail($request->domain_id);

            if($domain) {
                $shop->domain()->associate($domain);
                $shop->save();
            }
        }

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
