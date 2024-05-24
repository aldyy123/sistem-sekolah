<?php

namespace App\Service\Database;

use App\Models\Students;

class StudentService
{
    public function update($user_id, $payload)
    {
        $student = Students::where('user_id', $user_id)->first();
        if(is_null($student)){
            $payload['user_id'] = $user_id;
            $student = $this->create($payload);
        }else{
            $student->update($payload);
        }

        return $student;
    }

    public function create(array $data){
        $student = Students::create($data);
        return $student;
    }
}
