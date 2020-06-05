<?php 
namespace App\Business;

use App\DAL\RoleDAL;

class RoleBus extends BaseBus
{
	private $roleDAL;

	public function __construct()
	{
		$this->roleDAL = new RoleDAL();
	}

	public function getRoleDAL ()
	{
		return $this->roleDAL;
	}



	
}