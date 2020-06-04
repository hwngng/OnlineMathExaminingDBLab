<?php
namespace App\DAL;

use App\Common\ApiResult;
use App\DAL\BaseDAL;
use App\Models\Question;
use Illuminate\Support\Facades\Auth;

class QuestionDAL extends BaseDAL
{

	public function getAll ()
	{
		$questions = Question::select('content')->get();
		return $questions;
	}

	public function insert ($question)
	{
		$ret = new ApiResult();

		$questionORM = new Question();
		$questionORM->content = htmlspecialchars($question->content);
		$questionORM->solution_choice_ids = $question->solution_choice_ids;
		$questionORM->solution = $question->solution;

		$result = $questionORM->save();

		if ($result)
			$ret->fill('0', 'Success');
		else
			$ret->fill('1', 'Database error.');
		return $ret;
	}

	public function update ($question)
	{
		$ret = new ApiResult();
		try
		{
			if (isset($question->id))
			{
				$questionORM = Question::find($question->id);
				
				if (isset($question->content))
				{
					$questionORM->content = $question->content;
				}
				if (isset($question->solution_choice_ids))
				{
					$questionORM->solution_choice_ids = $question->solution_choice_ids;
				}
				if (isset($question->solution))
				{
					$questionORM->solution = $question->solution;
				}

				$result = $questionORM->save();

				if ($result)
					$ret->fill('0', 'Success.');
				else
					$ret->fill('1', 'Cannot find the question or database error.');
			}
			else 
			{
				$ret->fill('1', 'Uninitialized Question ID.');
			}
		}
		catch (\Exception $e)
		{
			$ret->fill($e->getCode(), $e->getMessage());
			// log smth
		}
		return $ret;
	}

	public function delete ($id)
	{
		$ret = new ApiResult();
		try
		{
			$question = Question::find($id);
			if (isset($question->id))
			{
				$question = Question::find($question->id);
				$question->deleted_by = Auth::id();
				$question->deleted_at = date('Y-m-d h:i:s');
				$result = $question->save();
				
				if ($result)
					$ret->fill('0', 'Success.');
				else
					$ret->fill('1', 'Cannot find the question or database error.');
			}
		}
		catch (\Exception $e)
		{
			$ret->fill($e->getCode(), $e->getMessage());
			// log smth
		}
		return $ret;
	}

	public function restore ($id)
	{
		$ret = new ApiResult();
		try
		{
			$question = Question::onlyTrashed()->find($id);
			$question->deleted_by = null;
			$question->deleted_at = null;
			$result = $question->save();

			if ($result)
				$ret->fill('0', 'Success.');
			else
				$ret->fill('1', 'Cannot find the question or database error.');
		}
		catch (\Exception $e)
		{
			$ret->fill($e->getCode(), $e->getMessage());
			// log smth
		}
		return $ret;
	}

}