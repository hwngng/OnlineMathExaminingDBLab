<?php

namespace App\Http\Controllers;

use App\Business\UserBus;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $userBus;
    private function getUserBus ()
    {
        if ($this->userBus == null)
        {
            $this->userBus = new UserBus();
        }
        return $this->userBus;
    }
    public function index ()
    {
        $apiResult = $this->getUserBus()->getAllForAdmin();
        $viewData = ['users' => $apiResult->users,
                    'schools' => $apiResult->schools,
                    'grades' => $apiResult->grades];

        return view('admin.user.index', $viewData);
    }
}
