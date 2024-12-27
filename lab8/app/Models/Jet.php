<?php

namespace App\Models;

use App\Observers\JetObserver;
use Database\Factories\JetFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

#[ObservedBy(JetObserver::class)]
class Jet extends Model
{
    /** @use HasFactory<\Database\Factories\JetFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'model',
        'capacity',
        'hourly_rate'
    ];

    protected static function newFactory()
    {
        return JetFactory::new();
    }

    public function reviews() {
        return $this->hasMany(Review::class);
    }
}
