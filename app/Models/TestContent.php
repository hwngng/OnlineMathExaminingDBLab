<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TestContent extends Model
{
    protected $table = 'test_content';
    public $timestamps = false;

    public function question ()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
	}
	
	public function scopeTests ($query)
    {
        return $query->join('test', function ($join)
        {
            $join->on('test.id', '=', 'test_content.test_id');
            $join->on('test.code', '=', 'test_content.test_code');
        });
    }
}
