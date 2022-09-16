<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDomainRequest;
use App\Http\Resources\DomainResource;
use App\Models\Domain;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Response as ResponseAlias;

class DomainApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return Admin::getCollection(Domain::query(), ['name'], $request, DomainResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDomainRequest $request
     * @return JsonResponse
     */
    public function store(StoreDomainRequest $request): JsonResponse
    {
        $limit = (int)setting('limits.domains');
        $user = User::findOrFail($request->user_id);
        $domains_limit = $user->loadCount('domains')->domains_count >= $limit;
        abort_if($domains_limit,
            ResponseAlias::HTTP_BAD_REQUEST,
            'Максимальное количество доменных имен уже достигнуто ('.$limit.').'
        );

        $is_valid_domain = true;

        if(!$request->isSubdomain) $is_valid_domain = filter_var($request->name, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME);

        abort_unless($is_valid_domain,
            ResponseAlias::HTTP_BAD_REQUEST,
            'Некорректное доменное имя.'
        );

        $domain = Domain::create($request->validated());
        return response()->json(new DomainResource($domain));
    }

    /**
     * Display the specified resource.
     *
     * @param Domain $domain
     * @return JsonResponse
     */
    public function show(Domain $domain): JsonResponse
    {
        return response()->json(new DomainResource($domain));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Domain $domain
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Domain $domain)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Domain $domain
     * @return JsonResponse
     */
    public function destroy(Domain $domain): JsonResponse
    {
        abort_if($domain->shop, Response::HTTP_BAD_REQUEST, 'Нельзя удалить домен, к которому привязан магазин');
        if(!$domain->shop) $domain->delete();
        return response()->json(new DomainResource($domain));
    }

    public function deleteMany(Request $request) {
        return Domain::whereIn('id', $request->ids)->delete();
    }
}
