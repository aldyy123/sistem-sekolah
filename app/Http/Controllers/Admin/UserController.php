<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Service\Database\ClassroomService;
use Illuminate\Http\Request;
use App\Service\Database\ExperienceService;
use App\Service\Database\SchedulesService;
use App\Service\Database\StudentService;
use App\Service\Database\SubjectService;
use App\Service\Database\SubjectTeacherService;
use App\Service\Database\TeacherService;
use App\Service\Database\UserService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
Use \Carbon\Carbon;

class UserController extends Controller
{
    public function dashboard() {
        $userService = new UserService;
        $experienceDB = new ExperienceService;
        $studentService = new StudentService;

        $userId = Auth::user()->id;

        $user = $userService->detail($userId);

        $pw_matches = Session::get('pw_matches') ?? 0;

        $time = date('H:i:a', time());

        // Admin Dashboard
        if ($user['role'] === 'ADMIN') {
            $users = $userService->index()['data'];
            return view('admin.dashboard', compact('users', 'pw_matches'));
        }

        // Teacher Dashboard
        if ($user['role'] === 'TEACHER') {
            return view('teacher.dashboard', compact('pw_matches'))
            ->with('user', $user);
        }

        // Student Dashboard
        if ($user['role'] === 'STUDENT') {
            $experience = Auth::user()->experience;

            if ($experience === null) {
                $student = $studentService->getStudentById($userId);
                $experienceDB->create($userId, ['grade' => $student->classroom->grade, 'experience_point' => 0, 'level' => 0]);

                $experience = Auth::user()->experience ?? 0;
            }

            $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;
            return view('student.dashboard', compact('pw_matches', 'user', 'experience'));
        }
    }

    public function scheduleDashboard(Request $request){
        $user = Auth::user();

        $query = $request->query();
        $schedules = new SchedulesService;
        $teacher = new TeacherService;
        $student = new StudentService;
        $subjectTeacher = new SubjectTeacherService;
        $classrooms = new ClassroomService;
        $subjects = new SubjectService;


        $listClassroom = $classrooms->index([
            'order_by' => 'asc'
        ]);


        if($user->role === "ADMIN"){
            $classroom_id = $query['classroom_id'] ?? $listClassroom['data'][0]['id'];

            $list = $schedules->index([
                'classroom_id' => $classroom_id,
            ]);

            foreach ($list as $key => $value) {
                $list[$key]['classroom'] = $classrooms->detail($value['classroom_id']);
            }

            $listClassroom = $classrooms->index([
                'order_by' => 'asc'
            ]);

            $mapel = $subjects->index();


            return view('admin.schedule', [
                'schedulesArray' => ['data' => $list],
                'classrooms' => $listClassroom,
                'query' => $classroom_id,
                'mapel' => $mapel,
                'user' => $user
            ]);
        }

        if($user->role === "STUDENT"){
            $experience = Auth::user()->experience;
            $experience->current_xp = $experience->experience_point % Experience::REQUIRED_XP;

            $user_student = $student->getStudentById($user->id);
            $list = $schedules->index([
                'classroom_id' => $user_student->classroom_id,
            ]);


            return view('student.schedule', [
                'schedulesArray' => ['data' => $list],
                'experience' => $experience,
                'user' => $user
            ]);
        }

        if($user->role === "TEACHER"){
            $list = $subjectTeacher->index([
                'teacher_id' => $user->id,
            ])->toArray();
            $subjects_ids = $subjectTeacher->filterFieldData($list['data'] ?? [], 'subject_id');

            $list = $schedules->index([
                'subject_id' => $subjects_ids,
            ]);

            return view('teacher.schedule', [
                'schedulesArray' => ['data' => $list],
                'user' => $user
            ]);
        }
    }

}
