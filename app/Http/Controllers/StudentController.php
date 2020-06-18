<?php

namespace App\Http\Controllers;

use App\Business\TestBus;
use App\Business\GradeBus;
use Illuminate\Http\Request;
use App\Business\QuestionBus;

class StudentController extends Controller
{
    private $testBus;
    private $questionBus;
    private $gradeBus;
    private function getTestBus()
    {
        if ($this->testBus == null) {
            $this->testBus = new TestBus();
        }
        return $this->testBus;
    }
    private function getQuestionBus()
    {
        if ($this->questionBus == null) {
            $this->questionBus = new QuestionBus();
        }
        return $this->questionBus;
    }
    private function getGradeBus()
    {
        if ($this->gradeBus == null) {
            $this->gradeBus = new GradeBus();
        }
        return $this->gradeBus;
    }
    public function index()
    {

        return view('student.index');
    }

    public function getTests()
    {
        $apiResult = $this->getTestBus()->getAll();
        $viewData = [
            'tests' => $apiResult->tests,
        ];
        return view('student.test.index', $viewData);
    }

    public function getTest( $testId )
    {
        $apiResult = $this->getTestBus()->getTest($testId);
        $viewData = [
            'test' => $apiResult->test
        ];
        \Debugbar::info($viewData['test']->questions);
        return view('student.test.join', $viewData);
    }



    public function about()
    {
        return view('student.test.index');
    }
}
