<?php

namespace OWS\Http\Controllers\Endpoints;

use OWS\Question;
use OWS\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EndpointOne extends Controller
{
    /**
     * Get random question ID back that matches conditions.
     *
     * @return \Illuminate\Http\Response
     */
    public function getQuestionId($difficulty, $category)
    {
        $question = Question::inRandomOrder()
            //->where('difficulty', '=', $difficulty)
            //->where('category', '=', $category)
            ->first();

        return $question->id;
    }

    /**
     * Return back question.
     *
     * @return \Illuminate\Http\Response
     */
    public function getQuestion($question)
    {
        $question = Question::find($question);

        return $question->question;
    }

    /**
     * Get answer back.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAnswer($answer, $answer_numbers)
    {
        $question = Question::find($answer);
        return $question->answers[$answer_numbers]->answer;
    }

    /**
     * Get explanation for correct answer.
     *
     * @return \Illuminate\Http\Response
     */
    public function getExplanation($question)
    {
        $question = Question::find($question);
        return $question->explanation;
    }
}
