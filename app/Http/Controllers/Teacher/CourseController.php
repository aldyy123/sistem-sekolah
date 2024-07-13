<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Service\Database\CourseService;
use App\Service\Database\SubjectService;
use App\Service\Database\SubjectTeacherService;
use App\Service\Database\TopicService;
use Illuminate\Http\Client\Pool;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $subjectTeacherDB = new SubjectTeacherService;
        $subjectDB = new SubjectService;

        $teacherId = Auth::user()->id;

        $teacherSubject = $subjectTeacherDB->index(['teacher_id' => $teacherId])->toArray();
        $subjectIds = collect($teacherSubject['data'])->pluck('subject_id');

        $subjects = [];
        foreach ($subjectIds as $key => $subjectId) {
            $dataSubject = $subjectDB->detail($subjectId);

            $subjects[$key] = $dataSubject;
        }

        $subject = collect($subjects)
            ->firstWhere('id', $request->subject_id) ?? null;

        return view('teacher.subject', compact('subject', 'subjects'))
            ->with('grades', config('constant.grades'));
    }

    public function detail(Request $request)
    {
        $coruseDB = new CourseService;
        $subjectDB = new SubjectService;

        $course = $coruseDB->detail($request->course_id);
        $subject = $subjectDB->detail($request->subject_id);
        $courses = $coruseDB->index(
            [
                'subject_id' => $request->subject_id,
                'by_grade' => 1,
            ]
        )['data'];

        return view('teacher.course', compact('courses', 'subject', 'course'));
    }

    public function getCourse(Request $request)
    {
        $subjectTeacherDB = new SubjectTeacherService;
        $coruseDB = new CourseService;
        $subjectDB = new SubjectService;


        if ($request->subject_id !== null) {
            $courses = $coruseDB->index(
                [
                    'subject_id' => $request->subject_id,
                    'by_grade' => 1,
                ]
            );
            $courses['total'] = count($courses['data']);
            return response()->json($courses);
        } else {
            $teacherSubject = $subjectTeacherDB->index(['teacher_id' => $request->teacher_id])->toArray();

            $subjectIds = collect($teacherSubject['data'])->pluck('subject_id');

            $subjects = [];
            foreach ($subjectIds as $key => $subjectId) {
                $dataSubject = $subjectDB->detail($subjectId);
                $dataCourse = $coruseDB->index([
                    'subject_id' => $subjectId,
                    'by_grade' => 1,
                ])['data'];

                $subjects[$key] = $dataSubject;
                $subjects[$key]['courses'] = $dataCourse;
                $subjects[$key]['count_course'] = count($dataCourse);
            }

            return response()->json($subjects);
        }
    }

    public function createCourse(Request $request)
    {
        $coruseDB = new CourseService;
        $userId = Auth::user()->id;


        return response()->json($coruseDB->create(
                $request->subject_id,
                [
                    'description' => $request->name,
                    'grade' => $request->grade,
                    'created_by' => $userId,
                ]
            ));
    }

    public function getCourseTopic(Request $request)
    {
        $topicDB = new TopicService;

        $topics = $topicDB->index([
            'subject_id' => $request->subject_id,
            'course_id' => $request->course_id,
        ]);

        $topics['total'] = count($topics['data']);

        return response()->json($topics);
    }

    public function createCourseTopic(Request $request)
    {
        $topicDB = new TopicService;
        $user = Auth::user();

        $topicLastOrder = $topicDB->index([
            'order_by' => 'DESC',
            'per_page' => 1,
        ])['data'];

        $total = $topicLastOrder[0]['order'] ?? 0;

        return response()->json($topicDB->create(
            $request->subject_id,
            $request->course_id,
            [
                'name' => $request->name,
                'order' => $total + 1,
            ]
        ));
    }
}
