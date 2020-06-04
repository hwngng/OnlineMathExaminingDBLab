<?php 
namespace App\DAL;

use App\DAL\BaseDAL;
use App\Models\Choice;
use App\Common\ApiResult;
use Illuminate\Support\Facades\Auth;

class ChoiceDAL extends BaseDAL
{
	public function insertForQuestion ($questionId, $choices)
	{
		$ret = new ApiResult();
		try
		{
			$choices = (array) $choices;
			$result = Choice::insert($choices);
			if ($result)
				$ret->fill('0', 'Success.');
			else
				$ret->fill('1', 'Cannot insert, database error.');
		}
		catch (\Exception $e)
		{
			$ret->fill($e->getCode(), $e->getMessage());
			// log smth
		}
		return $ret;
	}
}