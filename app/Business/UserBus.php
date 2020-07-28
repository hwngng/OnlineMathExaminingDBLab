<?php

namespace App\Business;

use App\DAL\UserDAL;
use App\Business\BaseBus;
use App\Business\GradeBus;
use App\Business\SchoolBus;
use JD\Cloudder\Facades\Cloudder;

class UserBus extends BaseBus
{
    private $userDAL;

    public function __construct()
    {
        $this->userDAL = new UserDAL();
        $this->gradeBus = new GradeBus();
        $this->schoolBus = new SchoolBus();
        $this->roleBus = new RoleBus();
    }

    public function getUserDAL()
    {
        return $this->userDAL;
    }


    public function getAllForAdmin()
    {
        $apiResult = $this->getUserDAL()->getAllForAdmin();
        $apiResult->grades = $this->gradeBus->getAllId()->grades;
        $apiResult->schools = $this->schoolBus->getAll()->schools;
        $apiResult->roles = $this->roleBus->getAll()->roles;

        return $apiResult;
    }



    public function getById($id)
    {
        $apiResult = $this->getUserDAL()->getById($id);

        $apiResult->grades = $this->gradeBus->getAllId()->grades;
        $apiResult->schools = $this->schoolBus->getAll()->schools;

        return $apiResult;
    }

    public function getByProviderId($id)
    {
        $apiResult = $this->getUserDAL()->getByProviderId($id);

        $apiResult->grades = $this->gradeBus->getAllId()->grades;
        $apiResult->schools = $this->schoolBus->getAll()->schools;

        return $apiResult;
    }


    public function insert($user)
    {

        $apiResult = $this->getUserDAL()->insert($user);
        return $apiResult;
    }

    public function insertBy3rdProvider($providerUserInfo, $provider)
    {
        $apiResult = $this->getUserDAL()->insert($providerUserInfo, $provider);
        return $apiResult;
    }







    public function update($user)
    {
        $apiResult = $this->getUserDAL()->update($user);

        return $apiResult;
    }

    public function destroy($userId)
    {
        return $this->getUserDAL()->destroy($userId);
    }
}
