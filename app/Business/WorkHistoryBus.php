<?php

namespace App\Business;

use App\Common\ApiResult;
use App\DAL\WorkHistoryDAL;
use App\Business\QuestionBus;
use App\Business\UserBus;
use App\Business\TestBus;


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

        $apiResult =  $this->getWorkHistoryDAL()->insert($resultForm);
        return $apiResult;
    }

    public function insertAnAnswer($resultForm, $testId)
    {
        $apiResult = new ApiResult();
        $apiResult =  $this->getWorkHistoryDAL()->insertAnAnswer($resultForm, $testId);
        return $apiResult;
    }

    public function getAll()
    {
        return $this->getWorkHistoryDAL()->getAll();
    }

    public function getWorkHistory($id)
    {
        return $this->getWorkHistoryDAL()->getById($id);
    }

    public function getWorkHistoryByTestIdAndUserId($userId,$testId)
    {
        $apiResult = $this->getWorkHistoryDAL()->getByTestIdAndUserId($userId,$testId);
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
