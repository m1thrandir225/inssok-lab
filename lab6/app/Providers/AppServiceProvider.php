<?php

namespace App\Providers;

use App\Repositories\CategoryRepository;
use App\Repositories\Interface\CategoryRepositoryInterface;
use App\Repositories\Interface\PostRepositoryInterface;
use App\Repositories\PostRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->singleton(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->singleton(PostRepositoryInterface::class, PostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
