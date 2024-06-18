<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Service\Database\ExperienceService;
use App\Service\Database\SchoolService;
use App\Service\Database\StudentService;
use Illuminate\Support\Facades\Auth;

class LeaderboardController extends Controller
{
    public function index() {
        $user = Auth::user();
        $experience = Auth::user()->experience;
        $experienceService = new ExperienceService;
        $studentService = new StudentService;

        $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;

        $filter = [
            'grade' => $user->grade,
            'with_users' => true,
            'order_by_xp' => true,
        ];

        $users = $experienceService->index($filter)['data'];
        $rankOrder = 1;
        $currentUserRank = 0;
        $students = [];

        foreach($users as $student) {
            if ($student['user_id'] === $user->id) {
                $currentUserRank = $rankOrder;
            }
            $student['rank_order'] = $rankOrder;
            $rankOrder++;
            $student['student'] = $studentService->getStudentById($student['user_id']);
            $students[] = $student;
        }

        return view('student.leaderboard.index')
            ->with('user', $user)
            ->with('currentUserRank', $currentUserRank)
            ->with('students', $students)
            ->with('experience', $experience);
    }
}
