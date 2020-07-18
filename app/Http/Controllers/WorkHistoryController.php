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


    public function __construct()
    {
        $this->workHistoryBus = $this->getWorkHistoryBus();
        $this->testBus = $this->getTestBus();
    }

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


    public function startTest($testId)
    {
        $apiResult = $this->getTestBus()->getTestForStudent($testId);
        $historyBus = $this->getWorkHistoryBus();




        $currentHistory = $historyBus->getWorkHistoryByTestIdAndUserId(Auth::id(), $testId)->workHistory;

        \Debugbar::info($currentHistory);


        if (is_null($currentHistory) || is_null($currentHistory->started_at)) {
            $apiHistoryResult = $historyBus->startHistory($testId, Auth::id(), now());
            $apiResult->test->remain = gmdate("i:s", $apiResult->test->duration * 60);
            $apiResult->test->remainInSecond = $apiResult->test->duration * 60;
        } else {

            $remainInSecond = $apiResult->test->duration * 60 - now()->diffInSeconds($currentHistory->started_at);

            \Debugbar::info($remainInSecond);

            if (
                $remainInSecond < 0
                || !is_null($currentHistory->ended_at)
                || !is_null($currentHistory->submitted_at)
            ) {
                return view('student.test.notavailable', ['test_id' => $testId]);
            }

            $remainingTime =  gmdate("i:s", $remainInSecond);
            $apiResult->test->remainInSecond = $remainInSecond;


            $apiResult->test->remain = $remainingTime;
        }

        $viewData = [
            'test' => $apiResult->test
        ];
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
