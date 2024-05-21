<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Service\Database\ContentService;
use App\Service\Database\TopicService;
use App\Models\Content;
use App\Service\Database\CourseService;
use App\Service\Database\SubjectService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicController extends Controller
{
    public function index(Request $request) {
        $subjectDB = new SubjectService;
        $courseDB = new CourseService;
        $topicDB = new TopicService;

        if ($request->content_id !== null) {
            $contentDB = new ContentService;

            $contentDB->detail($request->content_id);

            return view('teacher.topic.content')
                ->with('subject_id', $request->subject_id)
                ->with('course_id', $request->course_id)
                ->with('topic_id', $request->topic_id)
                ->with('content_id', $request->content_id);
        }

        $subject = $subjectDB->detail($request->subject_id);
        $course = $courseDB->detail($request->course_id);
        $topic = $topicDB->detail($request->topic_id);
        $topics = $topicDB->index([
            'subject_id' => $request->subject_id,
            'course_id' => $request->course_id,
        ]);

        return view('teacher.topic.index')
            ->with('subject', $subject)
            ->with('course', $course)
            ->with('topics', $topics['data'])
            ->with('topic', $topic);
    }

    public function getContents(Request $request) {
        $contentDB = new ContentService;

        $contents = $contentDB->index([
            'topic_id' => $request->topic_id,
            'order_by' => 'ASC',
        ]);
        $contents['total'] = count($contents['data']);

        return response()->json($contents);
    }

    public function getContent(Request $request) {
        $contentDB = new ContentService;

        return response()->json($contentDB->detail($request->content_id));
    }

    public function createContent(Request $request) {
        $contentDB = new ContentService;

        return response()->json($contentDB->create(
            $request->topic_id,
            [
                'name' => $request->name,
                'experience' => 25,
                'status' => Content::DRAFT,
            ]
        ));
    }

    public function updateContent(Request $request) {
        $contentDB = new ContentService;

        return response()->json($contentDB->update(
            $request->topic_id,
            $request->content_id,
            [
                'name' => $request->title,
                'content' => $request->content,
                'estimation' => $request->estimation ?? null,
                'experience' => $request->experience ?? 20,
                'status' => Content::DRAFT,
            ]
        ));
    }

    public function publishContent(Request $request) {
        $contentDB = new ContentService;

        $contentDB->update(
            $request->topic_id,
            $request->content_id,
            [
                'status' => $request->status,
            ]
        );

        return redirect()->back();
    }
}
