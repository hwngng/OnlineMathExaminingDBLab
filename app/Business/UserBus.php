<?php
namespace App\Business;

use App\DAL\UserDAL;
use App\Business\BaseBus;
use App\Business\GradeBus;
use App\Business\SchoolBus;

class UserBus extends BaseBus
{
	private $userDAL;

	public function __construct()
	{
		$this->userDAL = new UserDAL();
	}

	public function getUserDAL ()
	{
		return $this->userDAL;
	}


	public function getAllForAdmin ()
	{
        $apiResult = $this->getUserDAL()->getAllForAdmin();
        $gradeBus = new GradeBus();
        $schoolBus = new SchoolBus();
        $roleBus = new RoleBus();
        $apiResult->grades = $gradeBus->getAllId()->grades;
        $apiResult->schools = $schoolBus->getAll()->schools;
        $apiResult->roles = $roleBus->getAll()->roles;

        return $apiResult;
    }



    public function getById ($id)
	{
		$apiResult = $this->getUserDAL()->getById($id);

		return $apiResult;
	}

	public function insert($user)
	{
        \Debugbar::info($user->first_name);
		$apiResult = $this->getUserDAL()->insert($user);
		return $apiResult;
	}

	public function update ($user)
	{
		// $user['content'] = htmlspecialchars($user['content']);
		$apiResult = $this->getUserDAL()->update($user);
		// $choiceBus = new ChoiceBus();
		// $apiResult->updateChoice = $choiceBus->updateForuser($user['id'], $user['choices']);

		return $apiResult;
	}

	public function destroy ($userId)
	{
		return $this->getUserDAL()->destroy($userId);
	}
}
