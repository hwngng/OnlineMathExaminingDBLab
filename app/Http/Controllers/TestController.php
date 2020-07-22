<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Business\TestBus;
use App\Business\GradeBus;
use Illuminate\Http\Request;
use App\Business\QuestionBus;
use App\Http\Requests\TestRequest;

class TestController extends Controller
{
    private $testBus;
    private $questionBus;
    private $gradeBus;
    private function getTestBus ()
    {
        if ($this->testBus == null)
        {
            $this->testBus = new TestBus();
        }
        return $this->testBus;
    }
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
        $apiResult = $this->getTestBus()->getAll();

        foreach ($$apiResult->tests as $test) {
            $test->created_at = Carbon::parse($test->created_at)->diffForHumans();
        }

        $viewData = [
            'tests' => $apiResult->tests,
        ];

        return view('test.index', $viewData);
    }

    public function create ()
    {
        $apiResultGradeBus = $this->getGradeBus()->getAllId();
        $apiResultQuestionBus = $this->getQuestionBus()->getAll();
        $viewData = [
            'durations' => [5, 10, 15, 20, 25, 30, 45, 60, 90],
            'quantity' => [5, 10, 12, 15, 20, 30, 35, 40, 45, 50, 60],
            'grades' => $apiResultGradeBus->grades,
            'questions' => $apiResultQuestionBus->questions
        ];

        return view('test.create', $viewData);
    }

    public function store (TestRequest $testRequest)
    {
        $apiResult = $this->getTestBus()->insert($testRequest);

        return response()->json($apiResult->report());
    }

    public function edit ($testId)
    {
        $apiResultTestBus = $this->getTestBus()->getById($testId);
        $apiResultGradeBus = $this->getGradeBus()->getAllId();
        $apiResultQuestionBus = $this->getQuestionBus()->getAll();

        $viewData = [
            'test' => $apiResultTestBus->test,
            'grades' => $apiResultGradeBus->grades,
            'durations' => [5, 10, 15, 20, 25, 30, 45, 60, 90],
            'quantity' => [5, 10, 12, 15, 20, 30, 35, 40, 45, 50, 60],
            'questions' => $apiResultQuestionBus->questions
        ];

        return view('test.edit', $viewData);
    }

    public function update (TestRequest $testRequest)
    {

    }
}
