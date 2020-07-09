<?php

namespace App\Business;

use App\Common\ApiResult;
use App\DAL\WorkHistoryDAL;

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


    public function insertATest($resultForm)
    {
        $apiResult = new ApiResult();
        $apiResult =  $this->getWorkHistoryDAL()->insert($resultForm);
        return $apiResult;
    }

    public function insertAnAnswer($resultForm,$testId)
    {
        $apiResult = new ApiResult();
        $apiResult =  $this->getWorkHistoryDAL()->insertAnAnswer($resultForm,$testId);
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
}
