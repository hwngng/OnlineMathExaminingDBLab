<?php

namespace App\DAL;

use ReturnMsg;
use App\DAL\BaseDAL;
use App\Models\School;
use Illuminate\Support\Facades\Auth;
use App\Common\ApiResult;

class SchoolDAL extends BaseDAL
{
    public function getAll()
    {
        $apiResult = new ApiResult();

        $apiResult->schools = School::select('id', 'name', 'address')->get();
        return $apiResult;
    }
}
