<?php

namespace App\Http\Controllers;

use App\Actions\ApproveReviewAction;
use App\Actions\DeclineReviewAction;
use App\Http\Requests\StoreReviewRequest;
use App\Http\Requests\UpdateReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Http\Response;

class ReviewController extends Controller
{
    /**
     * Display a listing of reviews.
     *
     * @return AnonymousResourceCollection
     */
    public function index(Request $request)
    {
        $status = $request->input('status');

        $reviews = Review::query()
            ->when($status, fn(Builder $builder) => $builder->where('status', $status))
            ->paginate();

        return ReviewResource::collection($reviews);
    }

    /**
     * Store a newly created review in storage.
     *
     * @param  StoreReviewRequest  $request
     * @return ReviewResource
     */
    public function store(StoreReviewRequest $request)
    {
        $review = Review::create($request->validated());

        return ReviewResource::make($review);
    }

    /**
     * Display the specified review.
     *
     * @param Review $review
     * @return ReviewResource
     */
    public function show(Review $review)
    {
        $review->loadMissing('jet');
        return ReviewResource::make($review);
    }

    /**
     * Update the specified review in storage.
     *
     * @param  UpdateReviewRequest  $request
     * @param Review $review
     * @return ReviewResource
     */
    public function update(UpdateReviewRequest $request, Review $review)
    {
        $review->update($request->validated());
        return ReviewResource::make($review);
    }

    /**
     * Remove the specified review from storage.
     *
     * @param Review $review
     * @return JsonResponse
     */
    public function destroy(Review $review)
    {
        $review->delete();
        return JsonResponse::make([
            "message" => "Review deleted successfully"
        ]);
    }

    public function approveReview(Review $review): ReviewResource
    {
        (new ApproveReviewAction)->execute($review);

        return ReviewResource::make($review);
    }

    public function declineReview(Review $review): ReviewResource
    {
        (new DeclineReviewAction)->execute($review);

        return ReviewResource::make($review);
    }
}
