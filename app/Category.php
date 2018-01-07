<?php

namespace OWS;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'category'
    ];

    /**
     * Define a relationship between Category and Question.
     *
     * @var void
     */
    public function questions()
    {
        return $this->hasMany('OWS\Question');
    }
}
