<?php

namespace App\Service\Database;

use App\Models\Activity;
use App\Models\Question;
use App\Models\School;
use Illuminate\Support\Facades\Validator;
use Ramsey\Uuid\Uuid;

class QuestionService{

    public function index($filter = [])
    {
        $orderBy = $filter['order_by'] ?? 'DESC';
        $per_page = $filter['per_page'] ?? 99;
        $activityId = $filter['activity_id'] ?? null;


        $query = Question::orderBy('order', $orderBy);

        if ($activityId !== null) {
            $query->where('activity_id', $activityId);
        }

        $questions = $query->simplePaginate($per_page);

        return $questions->toArray();
    }

    public function detail($questionId)
    {
        $content = Question::findOrFail($questionId);

        return $content;
    }

    public function create($activityId, $payload)
    {
        Activity::findOrFail($activityId);

        $question = new Question();
        $question->id = Uuid::uuid4()->toString();
        $question->activity_id = $activityId;
        $question = $this->fill($question, $payload);
        $question->save();

        return $question->toArray();
    }

    public function update($activityId, $questionId, $payload)
    {
        Activity::findOrFail($activityId);

        $question = Question::findOrFail($questionId);
        $question = $this->fill($question, $payload);
        $question->save();

        return $question->toArray();
    }

    public function destroy($activityId, $questionId)
    {
        Activity::findOrFail($activityId);

        Question::findOrFail($questionId)->delete();

        return true;
    }

    private function fill(Question $question, array $attributes)
    {

        foreach ($attributes as $key => $value) {
            $question->$key = $value;
        }

        Validator::make($question->toArray(), [
            'activity_id' => 'required|string',
            'question' => 'required|string',
            'answer' => 'required|string',
            'explanation' => 'required|string',
            'order' => 'required|numeric',
            'choices' => 'required',
        ])->validate();

        return $question;
    }
}
