<?php

namespace App\DAL;

use App\Common\ApiResult;
use App\DAL\BaseDAL;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserDAL extends BaseDAL
{
    public function getAllForAdmin()
    {
        $apiResult = new ApiResult();

        $apiResult->users = User::select(
            DB::raw(
                'id,
                username,
                email,
                last_name,
                avatar,
                first_name,
                birthdate,
                telephone,
                address,
                role_ids as role_id,
                grade_id,
                school_id'
            )
        )
            ->orderBy('role_id')
            ->orderBy('username')
            ->get();

        return $apiResult;
    }



    public function getByProviderId($providerId)
    {
        $ret = new ApiResult();
        $user = User::select(
            DB::raw(
                'id,
                username,
                email,
                last_name,
                avatar,
                first_name,
                birthdate,
                telephone,
                address,
                role_ids as role_id,
                grade_id,
                school_id
                provider_user_id,
                provider
                ',

            )
        )->where('provider_user_id', $providerId)->first();
        $ret->user = $user;
        return $ret;
    }








    public function getById($id)
    {
        $ret = new ApiResult();
        $user = User::select(
            DB::raw(
                'id,
                username,
                email,
                last_name,
                avatar,
                first_name,
                birthdate,
                telephone,
                address,
                role_ids as role_id,
                grade_id,
                school_id'
            )
        )->where('id', $id)->first();
        $ret->user = $user;
        return $ret;
    }

    public function insert($user, $provider = 'none')
    {
        $ret = new ApiResult();

        $userORM = new User();

        if ($provider != 'none') {
            $userORM->username = $user['email'] ? $user['email'] : $user['id'];
            $userORM->provider_user_id = $user['id'];
            $userORM->role_ids = '3';
        } else {
            $userORM->username = $user['username'];
            $userORM->password = $user['password'];
            $userORM->role_ids = $user['role_ids'] ? $user['role_ids'] : '3';
        }



        if (isset($user['first_name'])) {
            $userORM->first_name = $user['first_name'];
        } else if (isset($user['given_name'])) {
            $userORM->first_name = $user['given_name'];
        } else if (isset($user['name'])) {
            $userORM->first_name = $user['name'];
        }


        if (isset($user['last_name'])) {
            $userORM->last_name = $user['last_name'];
        } else if (isset($user['family_name'])) {
            $userORM->last_name = $user['family_name'];
        }



        if (isset($user['avatar'])) {
            $userORM->avatar = $user['avatar'];
        } else if (isset($user['picture'])) {
            $userORM->avatar = $user['picture'];
        }


        if (isset($user['grade_id'])) {
            $userORM->grade_id = $user['grade_id'];
        }
        if (isset($user['school_id'])) {
            $userORM->school_id = $user['school_id'];
        }
        if (isset($user['birthdate'])) {
            $userORM->birthdate = $user['birthdate'];
        }
        if (isset($user['telephone'])) {
            $userORM->telephone = $user['telephone'];
        }

        if (isset($user['address'])) {
            $userORM->address = $user['address'];
        }

        if (isset($user['email'])) {
            $userORM->email = $user['email'];
        }


        $userORM->provider = $provider;


        $result = $userORM->save();


        if ($result) {
            $ret->fill('0', 'Success');
            $ret->userId = $userORM->id;
        } else
            $ret->fill('1', 'Cannot insert, database error.');
        return $ret;
    }

    public function update($user)
    {
        $ret = new ApiResult();
        try {
            if (isset($user['id'])) {
                $userORM = User::find($user['id']);

                if (isset($user['first_name'])) {
                    $userORM->first_name = $user['first_name'];
                }

                if (isset($user['last_name'])) {
                    $userORM->last_name = $user['last_name'];
                }

                if (isset($user['username'])) {
                    $userORM->username = $user['username'];
                }

                if (isset($user['email'])) {
                    $userORM->email = $user['email'];
                }

                if (isset($user['address'])) {
                    $userORM->address = $user['address'];
                }

                if (isset($user['school_id'])) {
                    $userORM->school_id = $user['school_id'];
                }

                if (isset($user['role_ids'])) {
                    $userORM->role_ids = $user['role_ids'];
                }

                if (isset($user['grade_id'])) {
                    $userORM->grade_id = $user['grade_id'];
                }


                if (isset($user['birthdate'])) {
                    $userORM->birthdate = $user['birthdate'];
                }

                if (isset($user['telephone'])) {
                    $userORM->telephone = $user['telephone'];
                }

                $result = $userORM->save();

                $ret->fill('0', 'Success.');
                $ret->affectedRows = $result;
            } else {
                $ret->fill('1', 'Uninitialized user ID.');
            }
        } catch (\Exception $e) {
            $ret->fill($e->getCode(), $e->getMessage());
            // log smth
        }
        return $ret;
    }

    public function destroy($id)
    {
        $ret = new ApiResult();
        try {
            $user = User::find($id);
            if (isset($user->id)) {
                $user = User::find($user->id);
                $user->deleted_by = Auth::id();
                $user->deleted_at = date('Y-m-d h:i:s');
                $result = $user->save();

                $ret->fill('0', 'Success.');
                $ret->affectedRows = $result;
            }
        } catch (\Exception $e) {
            $ret->fill($e->getCode(), $e->getMessage());
            // log smth
        }
        return $ret;
    }

    public function restore($id)
    {
        $ret = new ApiResult();
        try {
            $user = User::onlyTrashed()->find($id);
            $user->deleted_by = null;
            $user->deleted_at = null;
            $result = $user->save();

            $ret->fill('0', 'Success.');
            $ret->affectedRows = $result;
        } catch (\Exception $e) {
            $ret->fill($e->getCode(), $e->getMessage());
            // log smth
        }
        return $ret;
    }
}
