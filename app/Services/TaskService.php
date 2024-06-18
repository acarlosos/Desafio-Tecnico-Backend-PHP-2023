<?php

namespace App\Services;
use App\Models\Task;
use App\Repository\TaskRepository;
use App\Repository\TypeRepository;
use Carbon\Carbon;

class TaskService
{
    protected $repository;
    protected $typeRepository;
    public function __construct(TaskRepository $repository, TypeRepository $typeRepository) {
        $this->repository = $repository;
        $this->typeRepository = $typeRepository;
    }
    public function store($data)
    {
        $dates = [$data['start_date'], $data['finish_date']];
        if($this->repository->availablePeriod($dates)){
            $data = $this->checkType($data);
            return $this->repository->create($data);
        }else{
            throw new \Exception( "Unavailable period", 400);
        }
    }

    private function checkType($data)
    {
        if($type = $this->typeRepository->firstOrCreate( ['name' => $data['type'] ])){
            $data['type_id'] = $type->id;
            return $data;
        }
        throw new \Exception( "Unavailable type", 400);
    }

    public function update(int $id, $data)
    {
        if($task = $this->repository->find($id)){

            $start_date = Carbon::parse($data['start_date']);
            $finish_date = Carbon::parse($data['finish_date']);

            if($start_date == $task->start_date && $finish_date == $task->finish_date ){
                $data = $this->checkType($data);
                return $this->repository->update($id, $data);
            }else{
                $dates = [$data['start_date'], $data['finish_date']];
                if($this->repository->availablePeriod($dates)){
                    $data = $this->checkType($data);
                    return $this->repository->update($id, $data);
                }
                throw new \Exception( "Unavailable period", 400);
            }
        }
        throw new \Exception( "Unavailable Task", 400);
    }

}

