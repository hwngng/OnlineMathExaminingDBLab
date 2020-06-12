<?php
namespace App\DAL;

use App\Common\ApiResult;
use App\DAL\BaseDAL;
use App\Models\Question;
use App\Common\Constant;
use Illuminate\Support\Facades\Auth;

class QuestionDAL extends BaseDAL
{

	public function getAll ()
	{
		$ret = new ApiResult();
		$questions = Question::select('id',
									'content')
							->get();
		$ret->questions = $questions;
		return $ret;
	}

	public function getById ($id)
	{
		$ret = new ApiResult();
		$question = Question::select('id',
									'content',
									'grade_id',
									'solution')
							->where('id', $id)
							->with('choices:id,question_id,content,is_solution')
							->first();
		$ret->question = $question;
		return $ret;
	}

	public function insert ($question)
	{
		$ret = new ApiResult();

		$questionORM = new Question();
		$questionORM->content = $question['content'];
		$questionORM->solution = $question['solution'];

		$result = $questionORM->save();

		if ($result)
		{
			$ret->fill('0', 'Success');
			$ret->questionId = $questionORM->id;
		}
		else
			$ret->fill('1', 'Cannot insert, database error.');
		return $ret;
	}

	public function update ($question)
	{
		$ret = new ApiResult();
		try
		{
			if (isset($question['id']))
			{
				$questionORM = Question::find($question['id']);
				
				if (isset($question['content']))
				{
					$questionORM->content = $question['content'];
				}
				if (isset($question['solution']))
				{
					$questionORM->solution = $question['solution'];
				}

				$result = $questionORM->save();

				$ret->fill('0', 'Success.');
				$ret->affectedRows = $result;
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

	public function destroy ($id)
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
				
				$ret->fill('0', 'Success.');
				$ret->affectedRows = $result;
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