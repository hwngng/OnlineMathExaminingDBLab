<?php 
namespace App\Business;

use App\DAL\TestDAL;

class TestBus extends BaseBus
{
	private $testDAL;

	public function __construct()
	{
		$this->testDAL = new TestDAL();
	}

	public function getTestDAL ()
	{
		return $this->testDAL;
	}



	
}