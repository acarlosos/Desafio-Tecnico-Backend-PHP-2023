<?php

namespace App\Repository;
use App\Models\Type;
use Illuminate\Database\Eloquent\Model;

class TypeRepository extends BaseRepository
{

    public function __construct(Type $model) {
        $this->model = $model;
    }

    public function firstOrCreate($data): Model
    {
        return $this->model->firstOrCreate($data);
    }
}