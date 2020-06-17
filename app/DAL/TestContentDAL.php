<?php 
namespace App\DAL;

use ReturnMsg;
use App\DAL\BaseDAL;
use App\Common\ApiResult;
use App\Models\TestContent;
use Illuminate\Support\Facades\Auth;

class TestContentDAL extends BaseDAL
{
	public function insertMany ($testContents)
	{
		$ret = new ApiResult();
		try
		{
			$result = TestContent::insert($testContents);
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