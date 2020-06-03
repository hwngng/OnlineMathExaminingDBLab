<?php 
namespace App\Business;

use App\DAL\UserDAL;

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




}