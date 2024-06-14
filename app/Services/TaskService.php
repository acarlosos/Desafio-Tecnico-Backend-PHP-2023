<?php

namespace App\Services;
use Carbon\Carbon;

class TaskService
{
    public function store($data)
    {
        $data['user_id'] = auth()->user()->id;

        if(isset($data['start_date'])){
                $this->isWeekend( $data['start_date'], 'Start date');
        }
        if(isset($data['deadline'])){
                $this->isWeekend( $data['deadline'], 'Start date');
        }
        if(isset($data['finish_date'])){
                $this->isWeekend( $data['finish_date'], 'Start date');
        }

        $ok = \DB::select("SELECT * FROM tasks WHERE (? BETWEEN start_date AND finish_date) OR (? BETWEEN start_date AND finish_date)",
        [
            $data['start_date'],
            $data['finish_date']
        ]);
        if(count( $ok)){
            throw new \Exception( "Unavailable period", 1);
        }
        return $data;
    }

    private function isWeekend($date, $day)
    {
        $check = Carbon::parse($date);
        if($check->isWeekend()){
            throw new \Exception($day . " date is weekend", 1);
        }
    }
}