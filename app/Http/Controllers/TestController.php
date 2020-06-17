<?php

namespace App\Http\Controllers;

use App\Business\TestBus;
use App\Business\GradeBus;
use Illuminate\Http\Request;
use App\Business\QuestionBus;

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
        $viewData = [
            'tests' => $apiResult->tests,
        ];

        return view('test.index', $viewData);
    }

    public function create ()
    {
        return view('test.create');
    }
}
