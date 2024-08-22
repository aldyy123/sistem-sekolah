<?php

namespace App\Service\Database;

use App\Models\Classroom;

class ClassroomService
{
    public function getClassroomByCode($code)
    {
        $classroom = Classroom::where("code", $code)->first();
        if (!$classroom) {
            return null;
        }

        return $classroom;
    }

    public function detail($classroomId)
    {
        $classroom = Classroom::findOrFail($classroomId);

        return $classroom->toArray();
    }

    public function index($filter = []){
        $orderBy = $filter['order_by'] ?? 'desc';
        $per_page = $filter['per_page'] ?? 99;
        $code = $filter['code'] ?? null;
        $status = $filter['status'] ?? null;


        $query = Classroom::orderBy('grade', $orderBy);

        if ($code !== null) {
            $query->where('code', $code);
        }

        if ($status !== null) {
            $query->where('status', $status);
        }

        $contents = $query->simplePaginate($per_page);

        return $contents->toArray();
    }
}
