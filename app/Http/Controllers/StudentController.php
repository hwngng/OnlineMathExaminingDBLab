<?php

namespace App\Http\Controllers;

use App\Business\TestBus;
use App\Business\GradeBus;
use Illuminate\Http\Request;
use App\Business\QuestionBus;
use App\Business\WorkHistoryBus;
use App\Http\Requests\TestRequest;
use App\Http\Requests\UserRequest;
use DebugBar\DebugBar;

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

    public function index(TestRequest $request)
    {
        return $this->getAllAvailableTests($request);
        // return redirect()->route('student.test.list');
    }

    public function getAllAvailableTests(TestRequest $request)
    {
        $apiResult = $this->getTestBus()->getAll();
        $viewData = [
            'tests' => $apiResult->tests,
        ];
        \Debugbar::info($request->session());
        return view('student.test.index', $viewData);
    }





    public function about()
    {
        return view('student.test.index');
    }
}
