<?php

namespace App\Http\Controllers\Api;

use App\Helpers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreFeedBackRequest;
use App\Http\Requests\UpdateFeedBackRequest;
use App\Http\Resources\FeedBackResource;
use App\Models\FeedBack;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FeedbackApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request): JsonResponse
    {
        return Admin::getCollection(
            FeedBack::query(),
            ['email', 'theme', 'content', 'email'],
            $request,
            FeedBackResource::class
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreFeedBackRequest $request
     * @return JsonResponse
     */
    public function store(StoreFeedBackRequest $request): JsonResponse
    {
        $feedBack = FeedBack::create($request->validated());
        return response()->json(new FeedBackResource($feedBack));
    }

    /**
     * Display the specified resource.
     *
     * @param FeedBack $feedBack
     * @return JsonResponse
     */
    public function show(FeedBack $feedBack): JsonResponse
    {
        return response()->json(new FeedBackResource($feedBack));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateFeedBackRequest $request
     * @param FeedBack $feedBack
     * @return JsonResponse
     */
    public function update(UpdateFeedBackRequest $request, FeedBack $feedBack): JsonResponse
    {
        $feedBack->update($request->validated());
        return response()->json(new FeedBackResource($feedBack));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param FeedBack $feedBack
     * @return JsonResponse
     */
    public function destroy(FeedBack $feedBack): JsonResponse
    {
        $feedBack->delete();
        return response()->json(new FeedBackResource($feedBack));
    }
}
