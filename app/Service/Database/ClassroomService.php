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
}
