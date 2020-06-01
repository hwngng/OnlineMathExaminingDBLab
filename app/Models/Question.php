<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    protected $table = 'question';
    use SoftDeletes;
    public $timestamps = false;

    public function choices ()
    {
        return $this->hasMany('App\Models\Choice', 'question_id', 'id');
    }

    public function deletedBy ()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by', 'id');
    }

    public function grade ()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id', 'id');
    }

    public function workHistories ()
    {
        return $this->belongsToMany('App\Models\WorkHistory', 'work_history_detail', 'question_id', 'work_history_id');
    }

    public function scopeTests ($query)
    {
        return $query->join('test_content', function ($join)
        {
            $join->on('question.id', '=', 'test_content.test_code');
        })
        ->join('test', function($join)
        {
            $join->on('test.id', '=', 'test_content.test_id');
            $join->on('test.code', '=', 'test_content.test_code');
        });
    }
}
