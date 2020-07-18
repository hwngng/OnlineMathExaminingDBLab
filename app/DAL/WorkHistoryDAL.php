<?php

namespace App\DAL;

use ReturnMsg;
use App\DAL\BaseDAL;
use App\Common\ApiResult;
use App\Models\WorkHistory;
use Illuminate\Support\Facades\Auth;

class WorkHistoryDAL extends BaseDAL
{


    public function getAll()
    {

        $ret = new ApiResult();
        $workHistories = WorkHistory::select(
            'id',
            'user_id',
            'test_id',
            'no_of_correct',
            'started_at',
            'ended_at',
            'submitted_at'
        )
            ->with('work_history_id,question_id,choice_ids,updated_at')
            ->get();
        $ret->workHistories = $workHistories;

        return $ret;
    }

    public function getById($id)
    {
        $ret = new ApiResult();
        $workHistory = WorkHistory::select(
            'id',
            'user_id',
            'test_id',
            'no_of_correct',
            'started_at',
            'ended_at',
            'submitted_at'
        )
            ->where('id', $id)
            ->with('work_history_id,question_id,choice_ids,updated_at')
            ->first();
        $ret->workHistory = $workHistory;

        return $ret;
    }
    public function getByTestIdAndUserId($userId, $testId)
    {
        $ret = new ApiResult();
        $workHistory = WorkHistory::select(
            'id',
            'user_id',
            'test_id',
            'no_of_correct',
            'started_at',
            'ended_at',
            'submitted_at'
        )
            ->where([
                ['test_id', '=', $testId],
                ['user_id', '=', $userId],
            ])
            ->first();
        $ret->workHistory = $workHistory;

        return $ret;
    }

    public function getByTestId($testId)
    {
        $ret = new ApiResult();
        $workHistories = WorkHistory::select(
            'id',
            'user_id',
            'test_id',
            'no_of_correct',
            'started_at',
            'ended_at',
            'submitted_at'
        )->where('test_id', '=', $testId)
            ->get();
        $ret->workHistories = $workHistories;

        return $ret;
    }

    public function initialHistory($testId, $userId, $startTime)
    {
        $ret = new ApiResult();
        $workHistoryORM = WorkHistory::where('user_id', Auth::id())
            ->where('test_id', +$testId)
            ->first();

        if (is_null($workHistoryORM)) {
            $workHistoryORM = new WorkHistory();
            $workHistoryORM->test_id = +$testId;
            $workHistoryORM->user_id = +$userId;
        };

        $workHistoryORM->started_at = $startTime;

        $result = $workHistoryORM->save();

        if ($result) {
            $ret->fill('0', 'Success');
            $ret->workHistoryId = $workHistoryORM->id;
        } else
            $ret->fill('1', 'Cannot insert, database error.');
        return $ret;
    }

    public function insert($workHistory)
    {
        $ret = new ApiResult();


        $workHistoryORM = WorkHistory::where('user_id', Auth::id())
            ->where('test_id', +$workHistory['test_id'])
            ->first();

        if (is_null($workHistoryORM)) {
            $workHistoryORM = new WorkHistory();
            $workHistoryORM->test_id = +$workHistory['test_id'];
            $workHistoryORM->user_id = Auth::id();
        };

        $workHistoryORM->no_of_correct = $workHistory['no_of_correct'];
        $workHistoryORM->submitted_at = date("Y-m-d H:i:s");
        $workHistoryORM->ended_at = $workHistory['ended_at'];


        $result = $workHistoryORM->save();



        $workHistoryORM->questions()
            ->syncWithoutDetaching($workHistory['history_details']);



        if ($result) {
            $ret->fill('0', 'Success');
            $ret->workHistoryId = $workHistoryORM->id;
        } else
            $ret->fill('1', 'Cannot insert, database error.');
        return $ret;
    }



    public function insertAnAnswer($workHistory, $testId)
    {
        $ret = new ApiResult();
        $workHistoryORM = WorkHistory::where('user_id', Auth::id())
            ->where('test_id', +$testId)
            ->first();

        if (is_null($workHistoryORM)) {
            $workHistoryORM = new WorkHistory();
            $workHistoryORM->test_id = +$testId;
            $workHistoryORM->user_id = Auth::id();
        };

        $result = $workHistoryORM->save();

        $qid = $workHistory['question_id'];
        $cids = ['choice_ids' => $workHistory['choice_ids']];

        // if ( $workHistoryORM->questions->contains($qid)) {
        //     $workHistoryORM->questions()->save();
        // }
        $workHistoryORM->questions()
            ->syncWithoutDetaching([$qid => $cids]);

        if ($result) {
            $ret->fill('0', 'Success');
            $ret->workHistoryId = $workHistoryORM->id;
        } else
            $ret->fill('1', 'Cannot insert, database error.');
        return $ret;
    }
}
