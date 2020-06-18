<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Business\UserBus;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $userBus;
    private function getUserBus()
    {
        if ($this->userBus == null) {
            $this->userBus = new UserBus();
        }
        return $this->userBus;
    }
    public function index()
    {
        $apiResult = $this->getUserBus()->getAllForAdmin();
        $viewData = [
            'users' => $apiResult->users,
            'schools' => $apiResult->schools,
            'grades' => $apiResult->grades,
            'roles' => $apiResult->roles,
        ];

        return view('admin.user.index', $viewData);
    }


    public function createUser(UserRequest $request)
    {

        // TODO: insert new grade, school
        // $request->school_id = 1;

        $request->email = isset($request['email']) ? $request['email'] : NULL;
        $request->telephone = isset($request['telephone']) ? $request['telephone'] : NULL;
        $request->birthdate = isset($request['birthdate']) ? $request['birthdate'] : NULL;
        $request->password = Hash::make($request['password']);

        $apiResult = $this->getUserBus()->insert($request);
        return response()->json($apiResult->report());
    }

    public function update(UserRequest $userRequest)
    {
        $apiResult = $this->getUserBus()->update($userRequest);

        return response()->json($apiResult->report());
    }


    public function destroy($userId)
    {
        $apiResult = $this->getUserBus()->destroy($userId);

        return response()->json($apiResult->report());
    }
}
