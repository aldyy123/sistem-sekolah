<?php

namespace App\Service\Database;

use App\Models\School;
use App\Models\Subject;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class SubjectService{

    public function index($filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 20;
        $name = $filter['name'] ?? null;
        $classroom_id = $filter['classroom_id'] ?? null;
        $subject_id = $filter['subject_id'] ?? null;
        $relation = $filter['with_subject_teacher'] ?? false;


        $query = Subject::orderBy('created_at', $orderBy);

        if (!is_null($subject_id)) {
            if (is_array($subject_id)) {
                $query->whereIn('id', $subject_id);
            } else {
                $query->where('id', $subject_id);
            }
        }

        if ($classroom_id !== null) {
            if (is_array($classroom_id)) {
                $query->whereIn('classroom_id', $classroom_id);
            } else {
                $query->where('classroom_id', $classroom_id);
            }
        }

        if ($name !== null) {
            $query->where('name', $name);
        }

        if ($relation) {
            $query->with('subjectTeacher');
        }

        $subjects = $query->simplePaginate($per_page);

        return $subjects->toArray();
    }

    public function detail($subjectId)
    {
        $subject = Subject::findOrFail($subjectId);

        return $subject->toArray();
    }

    public function create($payload)
    {

        $subject = new Subject;
        $subject->id = Uuid::uuid4()->toString();
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject->toArray();
    }

    public function update($subjectId, $payload)
    {
        $subject = Subject::findOrFail($subjectId);
        $subject = $this->fill($subject, $payload);
        $subject->save();

        return $subject->toArray();
    }

    private function fill(Subject $subject, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $subject->$key = $value;
        }

        Validator::make($subject->toArray(), [
            'name' => 'required|string',
        ])->validate();

        return $subject;
    }
}
