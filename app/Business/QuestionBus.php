<?php

namespace App\Business;

use App\Business\BaseBus;
use App\DAL\QuestionDAL;
use App\Common\Constant;

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
	
	public function getById ($id)
	{
		$apiResult = $this->getQuestionDAL()->getById($id);

		return $apiResult;
	}

	public function insert($question)
	{
		$question['content'] = htmlspecialchars($question['content']);
		$question['solution'] = htmlspecialchars($question['solution']);
		$apiResult = $this->getQuestionDAL()->insert($question);
		$choiceBus = new ChoiceBus();
		$apiResult->insertChoice = $choiceBus->insertForQuestion($apiResult->questionId, $question['choices']);

		return $apiResult;
	}

	public function update ($question)
	{
		$question['content'] = htmlspecialchars($question['content']);
		$question['solution'] = htmlspecialchars($question['solution']);
		$apiResult = $this->getQuestionDAL()->update($question);
		$choiceBus = new ChoiceBus();
		$apiResult->updateChoice = $choiceBus->updateForQuestion($question['id'], $question['choices']);
		
		return $apiResult;
	}

	public function destroy ($questionId)
	{
		return $this->getQuestionDAL()->destroy($questionId);
	}
} 