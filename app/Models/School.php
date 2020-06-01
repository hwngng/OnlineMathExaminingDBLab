<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    protected $table = 'school';
    public $timestamps = false;

    public function users ()
    {
        return $this->hasMany('App\Models\User', 'school_id', 'id');
    }
}
