<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Business\WorkHistoryBus;
use App\Http\Requests\WorkHistoryRequest;
use App\Models\WorkHistory;

class WorkHistoryController extends Controller
{
    //
    private $workHistoryBus;
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
        \Debugbar::info($viewData['score']);
        return view('student.test.result', $viewData);
    }

    public function create(WorkHistoryRequest $requestForm)
    {
        $apiResult = $this->getWorkHistoryBus()->insert($requestForm);
        return response()->json($apiResult->report());
    }
}
