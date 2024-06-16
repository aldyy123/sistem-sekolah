<?php

namespace App\Service\Database;

use App\Models\Schedule;
use Illuminate\Support\Facades\Validator;

class SchedulesService
{
    public function index($filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $classroom_id = $filter['classroom_id'] ?? null;
        $subject_id = $filter['subject_id'] ?? null;
        $days = $filter['days'] ?? null;


        $query = Schedule::orderBy('days', $orderBy);

        if ($classroom_id !== null) {
            $query->where('classroom_id', $classroom_id);
        }

        if ($days !== null) {
            $query->where('days', $days);
        }

        if ($subject_id !== null) {
            $query->where('subject_id', $subject_id);
        }

        $contents = $query->with(['classroom', 'subject'])->get();

        return $contents->toArray();
    }

    public function create(Schedule $schedule){
        $schedule->save();

        return $schedule->toArray();
    }

    public function filled(Schedule $schedule, array $attributes){
        foreach ($attributes as $key => $value) {
            $schedule->$key = $value;
        }

        Validator::make($schedule->toArray(), [
            'start_time' => 'required',
            'end_time' => 'required|after:start_time',
            'classroom_id' => 'required|string',
            'subject_id' => 'required|string',
            'days' => 'required|string',
        ])->validate();

        return $schedule;
    }
}
