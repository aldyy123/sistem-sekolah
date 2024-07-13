<?php

namespace App\Service\Database;

use App\Models\Teachers;
use Illuminate\Support\Facades\Validator;

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
        $teacher = new Teachers;
        $teacher = $this->fill($teacher, $data);
        $teacher->save();
        return $teacher;
    }

    public function fill(Teachers $teachers, array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $teachers->$key = $value;
        }

        Validator::make($teachers->toArray(), [
            'user_id' => 'required',
            'last_education' => 'required|string',
            'nip' => 'required|string',
            'degree' => 'required',
        ])->validate();

        return $teachers;
    }
}
