<?php

namespace App\Repositories;

use App\Models\Category;
use App\Models\Post;
use App\Repositories\Interface\PostRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class PostRepository implements PostRepositoryInterface
{
    protected $model;

    public function __construct(Post $post)
    {
        $this->model = $post;
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function paginate(int $perPage = 15): LengthAwarePaginator
    {
        return $this->model->paginate($perPage);
    }

    public function findById(int $id): ?Model
    {
        return $this->model->find($id);
    }

    public function findBySlug(string $slug): ?Post
    {
        return $this->model->where('slug', $slug)->first();
    }

    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    public function update(Model $model, array $attributes): bool
    {
        return $model->update($attributes);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }

    public function withCategory(): Collection
    {
        return $this->model->with('category')->get();
    }

    public function findByCategory(Category $category, int $perPage = 15): LengthAwarePaginator
    {
        return $this->model
            ->where('category_id', $category->id)
            ->paginate($perPage);
    }

    public function latest(int $limit = 5): Collection
    {
        return $this->model
            ->latest()
            ->take($limit)
            ->get();
    }

    public function search(string $query): Collection
    {
        return $this->model
            ->where('title', 'LIKE', "%{$query}%")
            ->orWhere('body', 'LIKE', "%{$query}%")
            ->get();
    }
}
