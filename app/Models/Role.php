<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'role';
    public $timestamps = false;

    // public function users ()
    // {
    //     return $this->belongsToMany('App\Models\User', 'user_role', 'role_id', 'user_id')->withTimestamps();
    // }

    public static $ROLE = ['admin' => '1', 'teacher' => '2', 'student' => '3'];
}
