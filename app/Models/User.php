<?php

namespace App\Models;

use App\Models\Role;
use App\Common\Constant;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';
    use SoftDeletes;
    use Notifiable;
   
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getAuthPassword()
    {
      return $this->password;
    }

    /**
     * The roles that belong to the user.
     */
    // public function roles ()
    // {
    //     return $this->belongsToMany('App\Models\Role', 'user_role', 'user_id', 'role_id')->withTimestamps();
    // }

    public function deletedBy ()
    {
      return $this->belongsTo('App\Models\User', 'deleted_by', 'id');
    }

    public function school ()
    {
        return $this->belongsTo('App\Models\School', 'school_id', 'id');
    }

    public function grade ()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id', 'id');
    }

    public function workHistory ()
    {
        return $this->hasMany('App\Models\WorkHistory', 'user_id', 'id');
    }

    public function testCreated () 
    {
        return $this->hasMany('App\Models\Test', 'created_by', 'id');
    }

    public function hasARoleIn ($roles)
    {
        $currentRoles = explode(Constant::$SEPARATOR, $this->role_ids);
        foreach($roles as $role) {
            if (in_array(Role::$ROLE[$role], $currentRoles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole ($role)
    {
        $currentRoles = explode(Constant::$SEPARATOR, $this->role_ids);
        if (in_array(Role::$ROLE[$role], $currentRoles))
        {
            return true;
        }
        return false;
    }
}
