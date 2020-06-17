<?php 
namespace App\DAL;

use App\DAL\BaseDAL;
use App\Models\Choice;
use App\Common\ApiResult;
use Illuminate\Support\Facades\Auth;

class ChoiceDAL extends BaseDAL
{
	public function insertForQuestion ($questionId, $choices)
	{
		$ret = new ApiResult();
		try
		{
			$result = Choice::insert($choices);
			if ($result)
				$ret->fill('0', 'Success.');
			else
				$ret->fill('1', 'Cannot insert, database error.');
		}
		catch (\Exception $e)
		{
			$ret->fill($e->getCode(), $e->getMessage());
			// log smth
		}
		return $ret;
	}

	public function insert ($choice)
	{
		$ret = new ApiResult();

		if (isset($choice['question_id']) && isset($choice['id']))
		{
			$choiceORM = new Choice();
			$choiceORM->question_id = $choice['question_id'];
			$choiceORM->id = $choice['id'];
			$choiceORM->content = $choice['content'];
			$choiceORM->is_solution = $choice['is_solution'];

			$result = $choiceORM->save();

			if ($result)
			{
				$ret->fill('0', 'Success');
			}
			else
			{
				$ret->fill('1', 'Cannot insert, database error.');
			}
		}
		else 
		{
			$ret->fill('1', 'Uninitialized Choice ID or Question ID.');
		}
		return $ret;
	}

	public function updateOrCreate ($choice)
	{
		$ret = new ApiResult();
		try
		{
			if (isset($choice['question_id']) && isset($choice['id']))
			{
				$result = Choice::updateOrCreate(
									['question_id' => $choice['question_id'], 'id' => $choice['id']],
									['content' => $choice['content'], 'is_solution' => $choice['is_solution']]
								);

				$ret->fill('0', 'Success.');
				$ret->affectedRows = $result;
			}
			else 
			{
				$ret->fill('1', 'Uninitialized Choice ID.');
			}
		}
		catch (\Exception $e)
		{
			$ret->fill($e->getCode(), $e->getMessage());
			// log smth
		}
		return $ret;
	}

	public function destroy ($questionId, $choiceId)
	{
		$ret = new ApiResult();
		try
		{
			$result = Choice::where('question_id', $questionId)
							->where('id', $choiceId)
							->delete();
				
			$ret->fill('0', 'Success.');
			$ret->affectedRows = $result;
		}
		catch (\Exception $e)
		{
			$ret->fill($e->getCode(), $e->getMessage());
			// log smth
		}
		return $ret;
	}

}