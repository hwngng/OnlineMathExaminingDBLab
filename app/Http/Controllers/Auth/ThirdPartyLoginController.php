<?php

namespace App\Http\Controllers\Auth;

use App\Business\UserBus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Providers\RouteServiceProvider;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;


class ThirdPartyLoginController extends LoginController
{



    private $userBus;
    private function getUserBus()
    {
        if ($this->userBus == null) {
            $this->userBus = new UserBus();
        }
        return $this->userBus;
    }


    /**
     * Create a redirect method to provider api.
     *
     * @return void
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }


    /**
     * Obtain the user information from provider.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {

        $providerUserInfo = Socialite::driver($provider)->user();

        $user = $this->getUserBus()->getByProviderId($providerUserInfo['id'])->user;

        if(is_null($user)){
            $response = $this->createNewUser($providerUserInfo,$provider);
            $user = $this->getUserBus()->getById($response->userId)->user;
            Auth::login($user);
            return redirect()->route('student.about',$user->id);
        }


        Auth::login($user);

        return redirect()->to($this->redirectTo);
    }


    public function createNewUser($providerUserInfo,$provider)
    {
        $apiResult = $this->getUserBus()->insertBy3rdProvider($providerUserInfo,$provider);

        return $apiResult;
    }
}
