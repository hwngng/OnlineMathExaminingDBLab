<?php
namespace App\DAL;

use ReturnMsg;
use App\DAL\BaseDAL;
use App\Models\Grade;
use App\Common\ApiResult;
use Illuminate\Support\Facades\Auth;

class GradeDAL extends BaseDAL
{
	public function getAllId ()
	{
		$ret = new ApiResult();
		$grades = Grade::select('id')->get();
		$ret->grades = $grades;

		return $ret;
	}
}
