<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuestionRequest;
use App\Question;
use App\Test;

use Illuminate\Http\Request;

class CreateQuestionController extends Controller {

    public function index(Request $request) {
        return view('question', [
            'question' => $request->question != null ? Question::findOrFail($request->question) : null,
            'test' => $request->test
        ]);
    }

    public function onUpdateQuestion(QuestionRequest $request) {
        $question = Question::findOrFail($request->qId);

        $this->parse($question, $request);
        $question->update();

        return redirect()->route('settings', [
            'test' => $question->test_id
        ]);
    }

    public function onCreateQuestion(QuestionRequest $request) {
        $test = Test::findOrFail($request->test);

        $question = new Question();
        $question->test_id = $test->id;

        $this->parse($question, $request);
        $question->save();

        return redirect()->route('settings', [
            'test' => $test
        ]);
    }

    public function onDeleteQuestion(Request $request) {
        $test = Question::findOrFail($request->hiddenId);
        $test->delete();

        return redirect()->back();
    }

    private function parse(Question $question, Request $request) {
        $question->text = $request->question;
        $question->image_url = $request->imageUrl;
        $question->answers = $request->jsonHidden;
    }
}
