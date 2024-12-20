<?php

namespace App\Models;

use App\Observers\CategoryObserver;
use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[ObservedBy(CategoryObserver::class)]
class Category extends Model
{
    //
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function posts(): HasMany {
        return $this->hasMany(Post::class);
    }
}
