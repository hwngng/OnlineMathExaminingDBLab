<?php 
namespace App\DAL;

use ReturnMsg;
use App\DAL\BaseDAL;
use App\Models\Test;
use App\Common\ApiResult;
use App\Models\TestContent;
use Illuminate\Support\Facades\Auth;

class TestDAL extends BaseDAL
{
	public function getAll ()
	{
		$ret = new ApiResult();
		$tests = Test::select('id',
							'code',
							'name',
							'grade_id',
							'description',
							'no_of_questions',
							'created_at',
							'created_by')
					->with('createdBy:id,
									username,
									first_name,
									last_name')
					
					->get();
		$ret->tests = $tests;

		return $ret;
	}

	public function getById ($id, $code = 0)
	{
		$ret = new ApiResult();
		$test = Test::select('id',
							'code',
							'name',
							'grade_id',
							'description',
							'no_of_questions',
							'created_at',
							'created_by')
					->where('id', $id)
					->with('createdBy:id,
									username,
									first_name,
									last_name')
					->first();
		$ret->test = $test;

		$testContents = TestContent::select('question_id',
											'question_order')
									->where('test_id', $id)
									->where('test_code', $code)
									->with('question:content')
									->get();
		$ret->test->testContents = $testContents;

		return $ret;
	}

	public function insert ($test)
	{
		$ret = new ApiResult();

		$testORM = new Test();
		$testORM->code = 0;
		$testORM->name = $test['name'];
		$testORM->grade_id = $test['grade_id'];
		$testORM->description = $test['description'];
		$testORM->no_of_questions = $test['no_of_questions'];
		$testORM->created_at = date("Y-m-d H:i:s");
		$testORM->created_by = Auth::id();

		$result = $testORM->save();

		if ($result)
		{
			$ret->fill('0', 'Success');
			$ret->testId = $testORM->id;
		}
		else
			$ret->fill('1', 'Cannot insert, database error.');
		return $ret;
	}
}