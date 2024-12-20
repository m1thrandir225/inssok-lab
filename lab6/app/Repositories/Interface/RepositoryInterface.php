<?php

namespace App\Repositories\Interface;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;

interface RepositoryInterface
{
    public function all(): Collection;

    public function paginate(int $perPage = 15): LengthAwarePaginator;

    public function findById(int $id): ?Model;

    public function create(array $attributes): Model;

    public function update(Model $model, array $attributes): bool;

    public function delete(Model $model): bool;
}
