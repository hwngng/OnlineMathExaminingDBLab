<?php

namespace App\Business;

use App\Business\BaseBus;
use App\DAL\QuestionDAL;

class QuestionBus extends BaseBus
{
	private $questionDAL;

	public function __construct()
	{
		$this->questionDAL = new QuestionDAL();
	}

	public function getQuestionDAL ()
	{
		return $this->questionDAL;
	}



	public function getAll ()
	{
		return $this->getQuestionDAL()->getAll();
	}
	
	public function insert($question)
	{
		return $this->getQuestionDAL()->insert($question);
	}

	public function update ($question)
	{
		return $this->getQuestionDAL()->update($question);
	}

} 