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
    public function getQuestion(Request $request) {
        $category = $request->query('category');
        // Boolean to enable Construct 2 friendly response.
        $depression = $request->query('depression', true);

        // Filters the questions by category id.
        $query = Question::query()
            ->inRandomOrder()
            ->where('category_id', '=', $category)
            ->where('is_enabled', '=', true);

        // Filters the questions by difficulty if it has been defined.
        $question = $query->when(request('difficulty', false), function ($q, $difficulty) {
            return $q->where('difficulty', '=', $difficulty);
        })->firstOrFail();

        // The object that is returned.
        $data = filter_var($depression, FILTER_VALIDATE_BOOLEAN) ? [
            'c2array' => true,
            'data' => [
                'question' => $question->question,
                'answer1' => $question->answer1,
                'answer2' => $question->answer2,
                'answer3' => $question->answer3,
                'answer4' => $question->answer4,
                'explanation' => $question->explanation
            ]
        ] : [
            'question' => $question->question,
            'answers' => [
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
            ],
            'explanation' => $question->explanation
        ];

        return response()->json($data);
    }
}
