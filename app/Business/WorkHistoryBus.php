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


    public function insert($resultForm)
    {
        $apiResult = new ApiResult();
        $apiResult =  $this->getWorkHistoryDAL()->insert($resultForm);
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
