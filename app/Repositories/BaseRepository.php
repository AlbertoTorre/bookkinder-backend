<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

abstract class BaseRepository
{
    public function __construct(
        protected Model $model,
        public array $relation = []
    ) {
    }

    public function list(Request $request, array $only = ['search', 'sort'])
    {
        $query = $this->model->filter($request->only($only));

        if (count($this->relation)) {
            $query->with($this->relation);
        }

        if ($request->boolean('raw')) {
            return $query->get();
        }

        return $query->paginate($request->per_page ?? 15);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }

    public function find(int $id): Model
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data): Model
    {
        return $this->model->create($data);
    }

    public function update(Model $model, array $data): Model
    {
        $model->update($data);

        return $model;
    }

    public function updateById(int $id, array $data): int
    {
        return $this->model
                    ->where('id', $id)
                    ->update($data);
    }

    public function delete(Model $model): bool
    {
        return $model->delete();
    }
}
