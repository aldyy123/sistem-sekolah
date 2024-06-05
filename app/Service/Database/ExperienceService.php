<?php

namespace App\Service\Database;

use App\Models\Experience;
use App\Models\School;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class ExperienceService
{
    public function index($filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 999;
        $with_users = $filter['with_users'] ?? false;
        $by_xp = $filter['order_by_xp'] ?? false;
        $user_id = $filter['student_id'] ?? null;
        $grade = $filter['grade'] ?? null;


        $query = Experience::all();

        if($by_xp) {
            $query->orderBy('experience_point', $orderBy);
        } else {
            $query->orderBy('created_at', $orderBy);
        }

        if ($user_id !== null) {
            $query->where('user_id', $user_id);
        }

        if ($grade !== null) {
            $query->where('grade', $grade);
        }

        if($with_users) {
            $query->with('user');
        }

        $experiences = $query->simplePaginate($per_page);

        return $experiences->toArray();
    }

    public function detail($experienceId)
    {
        $experience = Experience::findOrFail($experienceId);

        return $experience->toArray();
    }

    public function create($userId, $payload)
    {
        User::findOrFail($userId);

        $experience = new Experience;
        $experience->id = Uuid::uuid4()->toString();
        $experience->user_id = $userId;
        $experience = $this->fill($experience, $payload);
        $experience->save();

        return $experience->toArray();
    }

    public function update($userId, $experienceId, $payload)
    {
        User::findOrFail($userId);
        $experience = Experience::findOrFail($experienceId);

        $currentExp = $experience->experience_point;

        $updateExp = $currentExp + $payload['experience'];

        $level = intdiv($updateExp, Experience::REQUIRED_XP);

        $attributes = [
            'user_id' => $userId,
            'level' => $level,
            'experience_point' => $updateExp,
        ];

        $experience = $this->fill($experience, $attributes);
        $experience->save();

        return $experience->toArray();
    }

    private function fill(Experience $experience, array $attributes)
    {
        foreach ($attributes as $key => $value) {
            $experience->$key = $value;
        }

        Validator::make($experience->toArray(), [
            'user_id' => 'required',
            'experience_point' => 'required|integer',
            'level' => 'required|integer',
            'grade' => 'required|integer'
        ])->validate();

        return $experience;
    }
}
