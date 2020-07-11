<?php

namespace App\Http\Controllers;

use App\Business\TestBus;
use App\Models\WorkHistory;
use Illuminate\Http\Request;
use App\Business\WorkHistoryBus;
use Facade\FlareClient\Time\Time;
use App\Http\Requests\TestRequest;
use Illuminate\Support\Facades\Auth;
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

    public function getResultByTestIdAndUserId($userId, $testId)
    {
        $apiResult = $this->getWorkHistoryBus()->getWorkHistoryByTestIdAndUserId($userId, $testId);
        $viewData = [
            'test' => $apiResult->test,
            'user' => $apiResult->user,
            'workHistory' => $apiResult->workHistory,
        ];
        return view('student.test.result', $viewData);
    }


    public function getTest(TestRequest $request, $testId)
    {
        $apiResult = $this->getTestBus()->getTestForStudent($testId);
        $viewData = [
            'test' => $apiResult->test
        ];

        if (!$request->session()->has('test_state')) {
            $request->session()->put('test_remaining_time', $viewData['test']->duration * 60);
            $request->session()->put('test_state', $testId);
            $request->session()->put('start_at', now());
            $viewData['test']->remain = $viewData['test']->duration;
            $viewData['test']->remain = gmdate("i:s", $viewData['test']->duration * 60);
            $viewData['test']->remainInSecond = $viewData['test']->duration * 60;
        } else {
            $startTime = $request->session()->get('start_at');
            $tmp = $viewData['test']->duration * 60 - now()->diffInSeconds($startTime);

            if ($tmp < 0 || $request->session()->get('test_state') == 'finish') {
                return view('student.test.notavailable', $viewData);
            }

            $remainingTime =  gmdate("i:s", $tmp);
            $viewData['test']->remain = $remainingTime;
            $viewData['test']->remainInSecond = $tmp;

            $request->session()->put('test_remaining_time', $tmp);
        }

        return view('student.test.start', $viewData);
    }

    public function updateTestResult(WorkHistoryRequest $request, $testId)
    {
        $apiResult = $this->getWorkHistoryBus()->insertAnAnswer($request, $testId);
        return response()->json($apiResult->report());
    }


    public function completeTest(WorkHistoryRequest $request)
    {
        $apiResult = $this->getWorkHistoryBus()->insertATestResult($request);

        $request->session()->put('test_state', 'finish');
        $request->session()->forget(['test_remaining_time', 'start_at']);

        return response()->json($apiResult->report());
    }


    public function showAllTestResult()
    {
        $apiResult = $this->getTestBus()->getAllInfo();

        $viewData = [
            'tests' => $apiResult->tests
        ];
        return view('teacher.result.list', $viewData);
    }

    public function getStudentResultByTestId($testId)
    {

        $apiResult = $this->getWorkHistoryBus()->getAllByTestId($testId);

        $viewData = [
            'test_name' => $apiResult->test_name,
            'workHistories' => $apiResult->workHistories,
            'no_of_questions' => $apiResult->no_of_questions,
        ];
        return view('teacher.result.detail', $viewData);
    }
}
