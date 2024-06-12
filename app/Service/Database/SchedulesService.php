<?php

namespace App\Service\Database;

use App\Models\Schedule;

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

        $contents = $query->with(['classroom', 'subject'])->simplePaginate($per_page);

        return $contents->toArray();
    }
}
