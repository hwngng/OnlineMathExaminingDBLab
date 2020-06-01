<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Test extends Model
{
    protected $table = 'test';
    use SoftDeletes;
    public $timestamps = false;

    public function grade ()
    {
        return $this->belongsTo('App\Models\Grade', 'grade_id', 'id');
    }

    public function deletedBy ()
    {
        return $this->belongsTo('App\Models\User', 'deleted_by', 'id');
    }

    public function createdBy ()
    {
        return $this->belongsTo('App\Models\User', 'created_by', 'id');
    }

    public function scopeWorkHistories ($query)
    {
        return $query->join('work_history', function ($join)
        {
            $join->on('test.id', '=', 'work_history.test_id');
            $join->on('test.code', '=', 'work_history.test_code');
        });
    }

    public function scopeQuestions ($query)
    {
        return $query->join('test_content', function ($join)
        {
            $join->on('test.id', '=', 'test_content.test_id');
            $join->on('test.code', '=', 'test_content.test_code');
        })
        ->join('question', function($join)
        {
            $join->on('question.id', '=', 'test_content.test_code');
        });
    }
}
