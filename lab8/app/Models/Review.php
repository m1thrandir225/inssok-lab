<?php

namespace App\Models;

use App\Observers\ReviewObserver;
use Database\Factories\ReviewFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ReviewObserver::class)]
class Review extends Model
{
    /** @use HasFactory<\Database\Factories\ReviewFactory> */
    use HasFactory;

    protected $fillable = [
        'jet_id',
        'reviewer_name',
        'description',
        'rating',
        'status'
    ];

    protected static function newFactory()
    {
        return ReviewFactory::new();
    }

    public function jet() {
        return $this->belongsTo(Jet::class);
    }
}
