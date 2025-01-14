<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreReviewRequest;
use App\Http\Resources\ReviewResource;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $status = $request->input('status');
        $yacht_id = $request->input('yacht_id');
        $reviews = Review::query()
            ->select([
                'reviews.id',
                'reviews.reviewer_name',
                'reviews.text',
                'reviews.rating',
                'reviews.status',
                'reviews.created_at'
            ])
            ->join('reservations', 'reservations.id', '=', 'reviews.reservation_id')
            ->join('yachts', 'yachts.id', '=', 'reservations.yacht_id')
            ->where('yachts.id', $yacht_id)
            ->where('status', $status)
            ->paginate();
        return ReviewResource::collection($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreReviewRequest $request)
    {
        //
        $review = Review::query()->create($request->validated());

        return ReviewResource::make($review);
    }

    /**
     * Display the specified resource.
     */
    public function show(Review $review)
    {
        //
        return ReviewResource::make($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        //
        $review->update($request->validate());
        return ReviewResource::make($review);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        //
        $review->delete();
        return JsonResource::make([
            'message' => 'Review deleted successfully',
        ]);
    }
}
