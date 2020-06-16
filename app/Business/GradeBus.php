<?php 
namespace App\Business;

use App\DAL\GradeDAL;

class GradeBus extends BaseBus
{
	private $gradeDAL;

	public function __construct()
	{
		$this->gradeDAL = new GradeDAL();
	}

	public function getGradeDAL ()
	{
		return $this->gradeDAL;
	}

	public function getAllId ()
	{
		return $this->getGradeDAL()->getAllId();
	}

	
}