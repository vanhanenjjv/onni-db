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
            ->where('difficulty', '=', $difficulty)
            ->where('category_id', '=', $category)
            ->where('is_enabled', '=', true)
            ->firstOrFail();

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
    public function getAnswer($answer, $answer_number)
    {
        $question = Question::find($answer);
        return $question->{'answer' . $answer_number};
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
