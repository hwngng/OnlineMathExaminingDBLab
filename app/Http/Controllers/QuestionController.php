<?php

namespace App\Http\Controllers;

use App\Common\ApiResult;
use App\Business\GradeBus;
use App\Business\QuestionBus;
use App\Http\Requests\QuestionRequest;

class QuestionController extends Controller
{
    private $questionBus;
    private $gradeBus;
    private function getQuestionBus ()
    {
        if ($this->questionBus == null)
        {
            $this->questionBus = new QuestionBus();
        }
        return $this->questionBus;
    }
    private function getGradeBus ()
    {
        if ($this->gradeBus == null)
        {
            $this->gradeBus = new GradeBus();
        }
        return $this->gradeBus;
    }

    public function index ()
    {
        $apiResult = $this->getQuestionBus()->getAll();
        $viewData = [
            'questions' => $apiResult->questions
        ];
        
        return view('question.index', $viewData);
    }

    public function getById ($id)
    {
        $apiResult = $this->getQuestionBus()->getById($id);

        return response()->json($apiResult->report('question'));
    }

    public function create ()
    {
        $apiResult = $this->getGradeBus()->getAllId();
        $viewData = [
            'grades' => $apiResult->grades
        ];

        return view('question.create', $viewData);
    }

    public function store (QuestionRequest $questionRequest)
    {
        $apiResult = $this->getQuestionBus()->insert($questionRequest);
        
        return response()->json($apiResult->report());
    }

    public function edit ($questionId)
    {
        $apiResultQuestion = $this->getQuestionBus()->getById($questionId);
        $apiResultGrade = $this->getGradeBus()->getAllId();
        $viewData = [
            'question' => $apiResultQuestion->question,
            'grades' => $apiResultGrade->grades
        ];
        
        return view('question.edit', $viewData);
    }

    public function update (QuestionRequest $questionRequest)
    {
        $apiResult = $this->getQuestionBus()->update($questionRequest);

        return response()->json($apiResult->report());
    }

    public function destroy ($questionId)
    {
        $apiResult = $this->getQuestionBus()->destroy($questionId);
        
        return response()->json($apiResult->report());
    }
}
