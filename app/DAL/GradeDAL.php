<?php
namespace App\DAL;

use ReturnMsg;
use App\DAL\BaseDAL;
use App\Models\Grade;
use App\Common\ApiResult;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class GradeDAL extends BaseDAL
{
	public function getAllId() {
		$apiResult = new ApiResult();

        $apiResult->grades = Grade::select('id')->get();
		return $apiResult;

    }

}
