<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDomainRequest;
use App\Http\Resources\DomainResource;
use App\Http\Resources\ModuleResource;
use App\Http\Services\AdminHelper;
use App\Models\Domain;
use App\Models\Module;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        return AdminHelper::getCollection(Domain::query(), ['name'], $request, DomainResource::class);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreDomainRequest $request
     * @return JsonResponse
     */
    public function store(StoreDomainRequest $request): JsonResponse
    {
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
        if(!$domain->shop) $domain->delete();
        return response()->json(new DomainResource($domain));
    }
}
