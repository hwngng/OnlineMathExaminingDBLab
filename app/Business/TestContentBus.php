<?php 
namespace App\Business;

use App\DAL\TestContentDAL;

class TestContentBus extends BaseBus
{
	private $testContentDAL;

	public function __construct()
	{
		$this->testContentDAL = new TestContentDAL();
	}

	public function getTestContentDAL ()
	{
		return $this->testContentDAL;
	}



	public function insertMany ($testId, $testCode, $questionIds)
	{
		$len = 0;
		$testContents = [];
		foreach ($questionIds as $questionId)
		{
			if (!empty($questionId))
			{
				$testContents[$len]['test_id'] = $testId;
				$testContents[$len]['test_code'] = $testCode;
				$testContents[$len]['question_id'] = $questionId;
			}

			++$len;
		}

		return $this->getTestContentDAL()->insertMany($testContents);
	}	
}