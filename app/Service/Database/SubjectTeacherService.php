<?php

namespace App\Service\Database;

use App\Models\SubjectTeacher;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class SubjectTeacherService {
    public function index($filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $teacherId = $filter['teacher_id'] ?? null;


        $query = SubjectTeacher::orderBy('created_at', $orderBy);

        if ($teacherId !== null) {
            $query->whereJsonContains('teachers', $teacherId);
        }

        $users = $query->with('subject')->simplePaginate($per_page);

        return $users->toArray();
    }

    public function filterFieldData(array $data, string $fieldName)
    {
        $filtered = [];

        foreach ($data as $key => $value) {
            if (isset($value[$fieldName])){
                array_push( $filtered, $value[$fieldName]);
            }
        }
        return $filtered;
    }

    public function detail($subjectTeacherId)
    {
        $subject = SubjectTeacher::findOrFail($subjectTeacherId);

        return $subject;
    }

    public function create($payload)
    {

        $subject = new SubjectTeacher();
        $subject->id = Uuid::uuid4()->toString();
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject;
    }

    public function update($subjectTeacherId, $payload)
    {
        $subject = SubjectTeacher::findOrFail($subjectTeacherId);
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject;
    }

    private function fill(SubjectTeacher $subject, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $subject->$key = $value;
        }

        Validator::make($subject->toArray(), [
            'subject_id' => 'required|string',
            'teachers' => 'nullable|array',
        ])->validate();

        return $subject;
    }
}
