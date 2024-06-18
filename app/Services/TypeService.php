<?php

namespace App\Services;
use App\Models\Type;
use App\Repository\TypeRepository;
use Carbon\Carbon;

class TypeService
{
    protected $repository;
    public function __construct(TypeRepository $repository) {
        $this->repository = $repository;
    }
    public function store($data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        $type = $this->repository->find($id);
        if(!$type->tasks->count()){
            return $this->repository->delete($id);
        }
        throw new \Exception("Error, you have tasks of this type", 400);
    }


}