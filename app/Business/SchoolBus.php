<?php
namespace App\Business;

use App\DAL\SchoolDAL;

class SchoolBus extends BaseBus
{
	private $schoolDAL;

	public function __construct()
	{
		$this->schoolDAL = new SchoolDAL();
	}

	public function getSchoolDAL ()
	{
		return $this->schoolDAL;
	}

    public function getAll ()
	{
		return $this->schoolDAL->getAll();
	}


}
