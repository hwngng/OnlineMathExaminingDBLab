<?php

namespace App\Http\Controllers;

use App\Business\QuestionBus;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    private $questionBus;
    private function getQuestionBus ()
    {
        if ($this->questionBus == null)
        {
            $this->questionBus = new QuestionBus();
        }
        return $this->questionBus;
    }

    public function index ()
    {
        $questions = $this->getQuestionBus()->getAll();
        $viewData = [
            'questions' => $questions
        ];
        
        return view('question.index', $viewData);
    }

    public function create ()
    {
        return view('question.create');
    }

    public function store (QuestionRequest $questionRequest)
    {
        $result = $this->getQuestionBus()->insert($questionRequest);

        return redirect(route('teacher.question.list'));
    }
}
