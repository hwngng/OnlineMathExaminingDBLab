<?php

namespace App\DAL;

use ReturnMsg;
use App\DAL\BaseDAL;
use App\Models\Role;
use App\Common\ApiResult;
use Illuminate\Support\Facades\Auth;

class RoleDAL extends BaseDAL
{
    public function getAll()
    {
        $apiResult = new ApiResult();

        $apiResult->roles = Role::select('id','name')->get();
        return $apiResult;
    }
}
