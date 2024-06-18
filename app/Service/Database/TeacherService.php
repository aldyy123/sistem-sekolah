<?php

namespace App\Service\Database;

use App\Models\Teachers;

class TeacherService
{
    public function update($user_id, $payload)
    {
        $user = Teachers::where('user_id', $user_id)->first();
        if (!$user) {
            $payload['user_id'] = $user_id;
            return $this->create($payload);
        }

        $user->update($payload);

        return $user;
    }

    public function findTeacher(string $user_id){
        $teacher = Teachers::where('user_id', $user_id)->get()->first();

        if(!$teacher){
            return null;
        }

        return $teacher;
    }

    public function create(array $data)
    {
        $user = Teachers::create($data);
        return $user;
    }
}
