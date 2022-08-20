<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use App\Models\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ReviewApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index(Shop $shop)
    {
        return ReviewResource::collection($shop->reviews);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Shop $shop
     * @param StoreReviewRequest $request
     * @return JsonResponse
     */
    public function store(Shop $shop, StoreReviewRequest $request)
    {
        $review = Review::create($request->validated() + ['shop_id' => $shop->id]);

        return response()->json(new ReviewResource($review));
    }

    /**
     * Display the specified resource.
     *
     * @param Review $review
     * @return JsonResponse
     */
    public function show(Shop $shop, Review $review): JsonResponse
    {
        return response()->json(new ReviewResource($review));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Shop $shop
     * @param StoreReviewRequest $request
     * @param Review $review
     * @return JsonResponse
     */
    public function update(Shop $shop, StoreReviewRequest $request, Review $review): JsonResponse
    {
        $review->update($request->validated());
        return response()->json(new ReviewResource($review));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Shop $shop
     * @param Review $review
     * @return JsonResponse
     */
    public function destroy(Shop $shop, Review $review): JsonResponse
    {
        $review->delete();
        return response()->json(new ReviewResource($review));
    }
}
