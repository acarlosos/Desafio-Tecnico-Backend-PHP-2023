<?php

namespace App\Repository;
use App\Models\Task;
use App\Models\Type;

class TaskRepository extends BaseRepository
{

    public function __construct(Task $model) {
        $this->model = $model;
    }

    public function availablePeriod($dates): bool
    {
        return ! Task::whereBetween('start_date', $dates )->orWhereBetween('finish_date', $dates)->count();
    }
}