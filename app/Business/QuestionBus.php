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
		$apiResult = $this->getQuestionDAL()->insert($question);
		$choiceBus = new ChoiceBus();
		$apiResult->insertChoice = $choiceBus->insertForQuestion($apiResult->questionId, $question->choices);

		return $apiResult;
	}

	public function update ($question)
	{
		return $this->getQuestionDAL()->update($question);
	}

	public function destroy ($questionId)
	{
		return $this->getQuestionDAL()->destroy($questionId);
	}
} 