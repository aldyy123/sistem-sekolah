<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Service\Database\SubjectService;
use App\Service\Database\SubjectTeacherService;
use App\Service\Database\UserService;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index() {
        $subjectService = new SubjectService;
        $userService = new UserService;

        $filter = [
            'order_by' => 'ASC',
            'with_subject_teacher' => true,
        ];

        $subjects = $subjectService->index($filter);

        $subjectsWithTeacher = [];
        foreach ($subjects['data'] as $subject) {
            if(!$subject['subject_teacher']) {
                continue;
            }

            $teachers = $userService->bulkDetail($subject['subject_teacher']['teachers'])['data'];
            $subject['teacher_details'] = $teachers;
            $subject['teacher_details_string'] = collect($teachers)->pluck('name')->join(', ');
            $subjectsWithTeacher[] = $subject;
        }


        $filter = [
            'per_page' => 99,
            'role' => 'TEACHER',
        ];

        $teachers = $userService->index($filter)['data'];


        return view('admin.subjects')
            ->with('subjects', $subjectsWithTeacher)
            ->with('teachers', $teachers);
    }

    public function create(Request $request) {
        $subjectService = new SubjectService;
        $subjectTeacherService = new SubjectTeacherService;

        $payload = [
            'name' => $request->subject_name,
        ];

        $subject = $subjectService->create($payload);

        $payload = [
            'subject_id' => $subject['id'],
            'teachers' => [],
        ];

        $subjectTeacherService->create($payload);

        return redirect()->back();
    }

    public function update(Request $request) {
        $subjectService = new SubjectService;

        $payload = [
            'name' => $request->subject_name,
        ];

        $subjectService->update($request->subject_id, $payload);

        return redirect()->back();
    }

    public function assign(Request $request) {
        $subjectTeacherService = new SubjectTeacherService;

        $teachers = collect($request->teacherIds)->unique();

        $payload = [
            'teachers' => $teachers->all(),
        ];

        $subjectTeacher = $subjectTeacherService->update($request->subjectTeacherId, $payload);

        return $subjectTeacher->toArray();
    }
}
