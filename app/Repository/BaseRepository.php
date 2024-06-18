<?php

namespace App\Repository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository
{
    protected $model;
    public function create($data): Model
    {
        return $this->model->create($data);
    }

    public function update(int $id, $data): Model
    {
        $this->model = $this->find($id);
        $this->model->update($data);
        return $this->model->fresh();
    }

    public function delete(int $id): bool
    {
        $this->model = $this->find($id);
        return $this->model->delete();
    }

    public function find(int $id): Model | null
    {
        return $this->model->find($id);
    }

    public function all(): Collection
    {
        return $this->model->all();
    }
}