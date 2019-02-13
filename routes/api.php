<?php

use Illuminate\Http\Request;

/*

/api/v1/questionId/{difficulty}/{category}
    {difficulty} - Can be 1 - 3
    {category} - Id of the category from which questions will be drawn

Returns ID of the question that matches the category and difficulty

--

/api/v1/question/{question}
    {question} - Id of the question

Returns the text form of question.

--

/api/v1/answer/{question}/{number}
    {question} - Id of the question
    {number} - Which answer, can be 1 - 4.

Returns the Nth answer for a question.

--

/api/v1/explanation/{question}
    {question} - Id of the question

Returns the answer explanation.

--

Psst. I didn't design the logic. Don't blame me.

*/

Route::prefix('v1')->group(function () {
    Route::get('questionId/{difficulty}/{category}', 'Endpoints\EndpointOne@getQuestionId')->name('api.v1.getQuestionId');
    Route::get('question/{question}', 'Endpoints\EndpointOne@getQuestion')->name('api.v1.getQuestion');
    Route::get('answer/{question}/{number}', 'Endpoints\EndpointOne@getAnswer')->name('api.v1.getAnswer');
    Route::get('explanation/{question}', 'Endpoints\EndpointOne@getExplanation')->name('api.v1.getExplanation');
});

Route::prefix('v2')->group(function () {
    Route::get('question', 'Endpoints\EndpointTwo@getQuestion')->name('api.v2.getQuestion');
});
