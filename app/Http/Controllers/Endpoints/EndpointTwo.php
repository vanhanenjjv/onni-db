<?php

namespace OWS\Http\Controllers\Endpoints;

use http\Env\Response;
use Illuminate\Http\Request;
use OWS\{
    Question,
    Http\Controllers\Controller
};

class EndpointTwo extends Controller
{
    public function getQuestion($category, $difficulty) {
        $question = Question::inRandomOrder()
            ->where('difficulty', '=', $difficulty)
            ->where('category_id', '=', $category)
            ->where('is_enabled', '=', true)
            ->firstOrFail();

        $answers = [
            [
                'answer' => $question->answer1,
                'isCorrect' => true
            ],
            [
                'answer' => $question->answer2,
                'isCorrect' => false
            ],
            [
                'answer' => $question->answer3,
                'isCorrect' => false
            ],
            [
                'answer' => $question->answer4,
                'isCorrect' => false
            ]
        ];

        $data = [
            'question' => $question->question,
            'answers' => $answers,
            'explanation' => $question->explanation
        ];

        return response()->json($data);
    }
}
