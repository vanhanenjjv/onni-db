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
        'question', 'difficulty', 'explanation', 'is_enabled'
    ];

    /**
     * Define a relationship between Question and Answer.
     *
     * @var void
     */
    public function answers()
    {
        return $this->hasMany('OWS\Answer');
    }
}
