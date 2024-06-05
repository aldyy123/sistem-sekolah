<?php

namespace App\Service\Database;

use App\Models\Students;
use Illuminate\Support\Facades\Validator;

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
        $student = new Students;
        $student = $this->fill($student, $data);
        $student->save();

        return $student;
    }

    private function fill(Students $students, array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $students->$key = $value;
        }

        Validator::make($students->toArray(), [
            'user_id' => 'required',
            'batch_id' => 'required|string',
            'classroom_id' => 'required|string',
            'degree' => 'required',
        ])->validate();

        return $students;
    }
}
