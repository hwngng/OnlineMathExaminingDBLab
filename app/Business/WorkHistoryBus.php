<?php

namespace App\Business;

use App\Common\ApiResult;
use App\DAL\WorkHistoryDAL;
use App\Business\QuestionBus;
use App\Business\UserBus;
use App\Business\TestBus;
use App\Models\WorkHistory;

class WorkHistoryBus extends BaseBus
{
    private $workHistoryDAL;

    public function __construct()
    {
        $this->workHistoryDAL = new WorkHistoryDAL();
    }

    public function getWorkHistoryDAL()
    {
        return $this->workHistoryDAL;
    }


    public function insertATestResult($resultForm)
    {
        $apiResult = new ApiResult();
        $count = 0;
        $historyDetails = array();
        for ($i = 0; $i < $resultForm['length']; $i++) {
            $qid = $resultForm['question_id'][$i];
            $cids = ['choice_ids' => $resultForm['choice_ids'][$i]];
            $count += $this->isRightQuestions($qid, $cids['choice_ids']);
            $historyDetails += [$qid => $cids];
        }
        $resultForm['no_of_correct'] = $count;

        $resultForm['history_details'] = $historyDetails;

        $resultForm['submitted_at'] = now();
        $apiResult =  $this->getWorkHistoryDAL()->insert($resultForm);
        return $apiResult;
    }

    public function insertAnAnswer($resultForm, $testId)
    {
        $apiResult = new ApiResult();
        $apiResult =  $this->getWorkHistoryDAL()->insertAnAnswer($resultForm, $testId);
        return $apiResult;
    }


    public function startHistory($testId,$userId,$startTime) {
        $apiResult = new ApiResult();
        $apiResult =  $this->getWorkHistoryDAL()->initialHistory($testId, $userId,$startTime);
        return $apiResult;

    }

    public function getAll()
    {
        $apiResult = $this->getWorkHistoryDAL()->getAll();
        $testBus = new TestBus();
        $userBus = new UserBus();

        foreach ($apiResult->workHistories as $workHistory) {
            $workHistory->test = $testBus->getInfoOnly(+$workHistory->test_id)->test;
            $workHistory->user = $userBus->getById(+$workHistory->userId)->user;
        }

        return $apiResult;
    }


    public function getAllByTestId($testId)
    {
        $apiResult = $this->getWorkHistoryDAL()->getByTestId($testId);
        $testBus = new TestBus();
        $userBus = new UserBus();
        $apiResult->no_of_questions = $testBus->getInfoOnly(+$testId)->test->no_of_questions;
        $apiResult->test_name = $testBus->getInfoOnly(+$testId)->test->name;

        foreach ($apiResult->workHistories as $workHistory) {
            $workHistory->user = $userBus->getById(+$workHistory->user_id)->user;
        }

        return $apiResult;
    }

    public function getWorkHistory($id)
    {
        return $this->getWorkHistoryDAL()->getById($id);
    }

    public function getWorkHistoryByTestIdAndUserId($userId, $testId)
    {
        $apiResult = $this->getWorkHistoryDAL()->getByTestIdAndUserId($userId, $testId);
        $testBus = new TestBus();
        $userBus = new UserBus();
        $apiResult->test = $testBus->getInfoOnly(+$testId)->test;
        $apiResult->user = $userBus->getById(+$userId)->user;

        return $apiResult;
    }


    public function isRightQuestions($questionId, $studentAnswer)
    {
        $questionBus = new QuestionBus();
        $apiResult = $questionBus->getById($questionId);
        $question = $apiResult->question;

        $choice = $question->choices->firstWhere('is_solution', '=', 1);

        if ($choice->id != $studentAnswer)
            return false;

        return true;
    }
}
