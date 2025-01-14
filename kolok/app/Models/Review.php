<?php

namespace App\Models;

use App\Enums\ReviewStatusEnum;
use App\Observers\ReviewObserver;
use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ReviewObserver::class)]
class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
        'reservation_id',
        'reviewer_name',
        'text',
        'status',
        'rating'
    ];

    protected $casts = [
        'status' => ReviewStatusEnum::class,
    ];

    protected static function newFactory()
    {
        return ReviewFactory::new();
    }

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
