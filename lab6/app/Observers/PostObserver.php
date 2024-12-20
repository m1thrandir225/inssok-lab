<?php

namespace App\Observers;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class PostObserver
{
    public function creating(Post $post)
    {
        if (!$post->slug) {
            $post->slug = Str::slug($post->title);
        }
    }

    public function updating(Post $post)
    {
        if ($post->isDirty('title')) {
            $post->slug = Str::slug($post->title);
        }
    }

    public function deleted(Post $post)
    {
        // Log the deletion
        Log::info('Post deleted: ' . $post->title);

        // Clear any related caches
        Cache::tags(['posts', 'category_' . $post->category_id])->flush();

    }

    public function forceDeleted(Post $post)
    {
        Log::info('Post permanently deleted: ' . $post->title);
        Cache::tags(['posts', 'category_' . $post->category_id])->flush();
    }

    public function restored(Post $post)
    {
        Log::info('Post restored: ' . $post->title);
        Cache::tags(['posts', 'category_' . $post->category_id])->flush();
        $post->category()->increment('post_count');
    }

}
