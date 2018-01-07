<?php

namespace OWS;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question', 'difficulty', 'explanation', 'is_enabled', 'answer1',
        'answer2', 'answer3', 'answer4'
    ];
}
