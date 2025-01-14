<?php

namespace App\Models;

use App\Enums\ReservationStatusEnum;
use App\Observers\ReservationObserver;
use Database\Factories\ReservationFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(ReservationObserver::class)]
class Reservation extends Model
{
    /** @use HasFactory<\Database\Factories\ReservationFactory> */
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
        'user_name',
        'yacht_id',
        'reservation_date',
        "status",
        'duration_hours',
    ];

    protected $casts = [
        'status' => ReservationStatusEnum::class,
    ];

    protected static function newFactory()
    {
        return ReservationFactory::new();
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function yacht()
    {
        return $this->belongsTo(Yacht::class);
    }
}
