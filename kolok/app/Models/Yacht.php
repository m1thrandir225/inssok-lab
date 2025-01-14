<?php

namespace App\Models;

use App\Enums\YachtTypeEnum;
use App\Observers\YachtObserver;
use Database\Factories\YachtFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(YachtObserver::class)]
class Yacht extends Model
{
    /** @use HasFactory<\Database\Factories\YachtFactory> */
    use HasFactory;
    use HasTimestamps;

    protected $fillable = [
        'type',
        'name',
        'capacity',
        'hourly_rate',
    ];

    protected static function newFactory()
    {
        return YachtFactory::new();
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }

    protected $casts = [
        'type' => YachtTypeEnum::class,
    ];
}
