<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    protected $table = 'choice';
    public $timestamps = false;
    protected $fillable = ['question_id', 'id', 'content', 'is_solution'];

    public function question ()
    {
        return $this->belongsTo('App\Models\Question', 'question_id', 'id');
    }
}
