<?php

// app/Repositories/CategoryRepository.php
namespace App\Repositories;

use App\Models\Category;
use App\Repositories\Interface\CategoryRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

class CategoryRepository implements CategoryRepositoryInterface
{
    protected $model;

    public function __construct(Category $category)
    {
        $this->model = $category;
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

    public function findBySlug(string $slug): ?Category
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

    public function withPosts(): Collection
    {
        return $this->model->with('posts')->get();
    }

    public function search(string $query): LengthAwarePaginator
    {
        return $this->model
            ->where('name', 'like', "%{$query}%")
            ->latest()
            ->paginate(100);
    }
}
