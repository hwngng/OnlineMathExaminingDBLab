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

    public function insert($schoolName) {

        $ret = new ApiResult();

        $schoolORM = new School();
        $schoolORM->name = $schoolName;

        $result = $schoolORM->save();

        if ($result) {
            $ret->fill('0', 'Success');
            $ret->schoolId = $schoolORM->id;
        } else
            $ret->fill('1', 'Cannot insert, database error.');
        return $ret;

    }

}
