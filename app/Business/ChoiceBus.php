<?php 
namespace App\Business;

use App\Common\ApiResult;
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
		$choices = [];
		foreach ($choicesForm as $choice)
		{
			$choices[$len]['question_id'] = $questionId;
			$choices[$len]['id'] = $len;
			$choices[$len]['content'] = htmlspecialchars($choice['content']);
			$choices[$len]['is_solution'] = $choice['sol'] == '1' ? 1 : 0;
			
			++$len;
		}
		return $this->getChoiceDAL()->insertForQuestion($questionId, $choices);
	}

	public function insert ($choice)
	{
		return $this->getChoiceDAL()->insert($choice);
	}

	public function updateOrCreate ($choice)
	{
		return $this->getChoiceDAL()->updateOrCreate($choice);
	}

	public function updateForQuestion ($questionId, $choicesForm)
	{
		$len = 0;
		$apiResult = new ApiResult();
		$apiResult->updateChoices = [];
		foreach ($choicesForm as $choiceForm)
		{
			$choice['question_id'] = $questionId;
			$choice['id'] = $len;
			$choice['content'] = htmlspecialchars($choiceForm['content']);
			$choice['is_solution'] = isset($choiceForm['sol']) && $choiceForm['sol'] == '1' ? 1 : 0;
			
			if (empty($choice['content']))
			{
				$this->destroy($choice['question_id'], $choice['id']);
				continue;
			}
			$ret = $this->updateOrCreate($choice);
			$apiResult->updateChoices[$len] = $ret;

			++$len;
		}
		return $apiResult;
	}

	public function destroy ($questionId, $choiceId)	
	{
		return $this->getChoiceDAL()->destroy($questionId, $choiceId);
	}
}