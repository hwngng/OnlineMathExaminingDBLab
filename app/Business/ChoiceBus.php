<?php 
namespace App\Business;

use App\DAL\ChoiceDAL;

class ChoiceBus extends BaseBus
{
	private $choiceDAL;

	public function __construct()
	{
		$this->choiceDAL = new ChoiceDAL();
	}

	public function getChoiceDAL ()
	{
		return $this->choiceDAL;
	}



	
}