<?php

namespace App\Observers;

use App\Models\Review;
use Illuminate\Support\Facades\Log;

class ReviewObserver
{
    /**
     * Handle the Review "created" event.
     */
    public function created(Review $review): void
    {
        Log::info('New review created', [
            'id' => $review->id,
            'jet_id' => $review->jet_id,
            'rating' => $review->rating,
            'status' => 'pending',
        ]);

        // You might want to update jet's average rating
        $this->updateJetAverageRating($review);
    }

    /**
     * Handle the Review "updated" event.
     */
    public function updated(Review $review): void
    {
        Log::info('Review updated', [
            'id' => $review->id,
            'changes' => $review->getDirty()
        ]);

        if ($review->isDirty('rating')) {
            $this->updateJetAverageRating($review);
        }
    }

    /**
     * Handle the Review "deleted" event.
     */
    public function deleted(Review $review): void
    {
        Log::info('Review deleted', [
            'id' => $review->id,
            'jet_id' => $review->jet_id
        ]);

        $this->updateJetAverageRating($review);
    }

    /**
     * Handle the Review "restored" event.
     */
    public function restored(Review $review): void
    {
        Log::info('Review restored', [
            'id' => $review->id,
            'jet_id' => $review->jet_id
        ]);

        $this->updateJetAverageRating($review);
    }

    /**
     * Handle the Review "force deleted" event.
     */
    public function forceDeleted(Review $review): void
    {
        Log::info('Review force deleted', [
            'id' => $review->id,
            'jet_id' => $review->jet_id
        ]);
    }

    /**
     * Update the associated jet's average rating.
     */
    private function updateJetAverageRating(Review $review): void
    {
        $jet = $review->jet;
        $averageRating = $jet->reviews()
            ->where('status', 'approved')
            ->avg('rating');

        // You might want to store this average in the jets table
        // This would require adding an average_rating column to jets table
        // $jet->update(['average_rating' => $averageRating]);

        Log::info('Updated jet average rating', [
            'jet_id' => $jet->id,
            'new_average' => $averageRating
        ]);
    }
}
