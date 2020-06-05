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



	public function insertForQuestion ($questionId, $choicesForm)
	{
		$len = 0;
		$choices = (object) [];
		foreach ($choicesForm as $choice)
		{
			$choices->question_id = $questionId;
			$choices->id = $len;
			$choices->content = $choice['content'];
			++$len;
		}
		$this->getChoiceDAL()->insertForQuestion($questionId, $choices);
	}
}