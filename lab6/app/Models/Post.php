<?php

namespace App\Models;

use App\Observers\PostObserver;
use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

#[ObservedBy(PostObserver::class)]
class Post extends Model
{
    use SoftDeletes;
    use HasFactory;
    protected $fillable = [
        'title',
        'slug',
        'body',
        'category_id',
    ];


    protected static function newFactory()
    {
        return PostFactory::new();
    }

    public function category(): BelongsTo {
        return $this->belongsTo(Category::class);
    }
}
