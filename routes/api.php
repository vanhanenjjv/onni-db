<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*** API endpoint for games ***/
/*

/api/v1/question/{difficulty}/{category}
    {difficulty} - Can be 1 - 3
    {category} -

Returns ID of the question that matches the category and difficulty

/api/v1/answer/{question}/{number}
    {question} - ID for question
    {number} - Answer order number. Can be 0 - 3.
Returns {number} anwer for the question.

*/

Route::get('/v1/questionId/{difficulty}/{category}', 'Endpoints\EndpointOne@getQuestionId')->name('api.v1.getQuestionId');
Route::get('/v1/question/{question}', 'Endpoints\EndpointOne@getQuestion')->name('api.v1.getQuestion');
Route::get('/v1/answer/{question}/{number}', 'Endpoints\EndpointOne@getAnswer')->name('api.v1.getAnswer');
Route::get('/v1/explanation/{question}', 'Endpoints\EndpointOne@getExplanation')->name('api.v1.getExplanation');
