<?php

namespace App\Http\Controllers;

use App\Business\QuestionBus;
use App\Common\ApiResult;
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
        $apiResult = $this->getQuestionBus()->getAll();
        $viewData = [
            'questions' => $apiResult->questions
        ];
        
        return view('question.index', $viewData);
    }

    public function create ()
    {
        return view('question.create');
    }

    public function store (QuestionRequest $questionRequest)
    {
        $apiResult = $this->getQuestionBus()->insert($questionRequest);
        return response()->json($apiResult->report());
    }

    public function edit ($questionId)
    {
        $apiResult = $this->getQuestionBus()->getById($questionId);
        $viewData = [
            'question' => $apiResult->question
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
