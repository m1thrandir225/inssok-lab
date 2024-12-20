<?php

namespace App\Repositories\Interface;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function findBySlug(string $slug): ?Post;

    public function withCategory(): Collection;

    public function findByCategory(Category $category, int $perPage = 15): LengthAwarePaginator;

    public function latest(int $limit = 5): Collection;

    public function search(string $query): Collection;
}
