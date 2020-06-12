<?php 
namespace App\DAL;

use App\Common\ApiResult;
use App\DAL\BaseDAL;
use App\Models\User;
use App\Models\Grade;
use App\Models\School;
use Illuminate\Support\Facades\Auth;

class UserDAL extends BaseDAL
{
	public function getAllForAdmin ()
	{
		$apiResult = new ApiResult();

		$apiResult->users = User::select('id',
										'username',
										'email',
										'last_name',
										'first_name',
										'birthdate',
										'mobile_phone',
										'telephone',
										'grade_id',
										'address',
										'parent_name',
										'parent_phone',
										'role_ids')
							->with('school:id,name')
							->get();
		$apiResult->grades = Grade::select('id')->get();
		$apiResult->schools = School::select('id', 'name', 'address')->get();

		return $apiResult;
	}
}