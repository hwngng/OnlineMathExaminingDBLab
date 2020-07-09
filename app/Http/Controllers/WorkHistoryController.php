<?php

namespace App\Http\Controllers;

use App\Business\TestBus;
use App\Models\WorkHistory;
use Illuminate\Http\Request;
use App\Business\WorkHistoryBus;
use App\Http\Requests\TestRequest;
use App\Http\Requests\WorkHistoryRequest;

class WorkHistoryController extends Controller
{
    //
    private $workHistoryBus;
    private $testBus;

    private function getTestBus()
    {
        if ($this->testBus == null) {
            $this->testBus = new TestBus();
        }
        return $this->testBus;
    }
    private function getWorkHistoryBus()
    {
        if ($this->workHistoryBus == null) {
            $this->workHistoryBus = new WorkHistoryBus();
        }
        return $this->workHistoryBus;
    }

    public function getResultById($workHistoryId)
    {
        $apiResult = $this->getWorkHistoryBus()->getWorkHistory($workHistoryId);
        $viewData = [
            'score' => $apiResult->score
        ];
        return view('student.test.result', $viewData);
    }


    public function getTest(TestRequest $request, $testId)
    {
        $apiResult = $this->getTestBus()->getTestForStudent($testId);
        $viewData = [
            'test' => $apiResult->test
        ];
        $request->session()->put('doing_test_timer', $viewData['test']->duration);
        \Debugbar::info($request->session());
        return view('student.test.start', $viewData);
    }

    public function updateTestResult(WorkHistoryRequest $request, $testId)
    {
        $apiResult = $this->getWorkHistoryBus()->insertAnAnswer($request, $testId);
        return response()->json($apiResult->report());
    }


    public function completeTest(WorkHistoryRequest $request)
    {
        $apiResult = $this->getWorkHistoryBus()->insertATest($request);
        return response()->json($apiResult->report());
    }
}
