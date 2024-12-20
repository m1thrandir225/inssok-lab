<?php

namespace App\Observers;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class CategoryObserver
{
    public function creating(Category $category)
    {
        if (!$category->slug) {
            $category->slug = Str::slug($category->name);
        }
    }

    public function updating(Category $category)
    {
        if ($category->isDirty('name')) {
            $category->slug = Str::slug($category->name);
        }
    }

    public function deleted(Category $category)
    {
        Log::info('Category deleted: ' . $category->name);
        $category->posts()->delete();
    }

    public function forceDeleted(Category $category)
    {
        Log::info('Category permanently deleted: ' . $category->name);
        $category->posts()->forceDelete();
    }

    public function restored(Category $category)
    {
        Log::info('Category restored: ' . $category->name);
        $category->posts()->restore();
    }
}
