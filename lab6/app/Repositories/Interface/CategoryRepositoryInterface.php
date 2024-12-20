<?php

namespace App\Repositories\Interface;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

interface CategoryRepositoryInterface extends RepositoryInterface
{
    public function findBySlug(string $slug): ?Category;

    public function withPosts(): Collection;

    public function search(string $query): LengthAwarePaginator;
}
