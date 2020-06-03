<?php 
namespace App\Business;

use App\DAL\WorkHistoryDAL;

class WorkHistoryBus extends BaseBus
{
	private $workHistoryDAL;

	public function __construct()
	{
		$this->workHistoryDAL = new WorkHistoryDAL();
	}

	public function getWorkHistoryDAL ()
	{
		return $this->workHistoryDAL;
	}



	
}