<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/

/* Laravel authentication routes */
Auth::routes();

/* List questions */
Route::get('/', 'Questions\QuestionController@index')->name('question.all');

// New question
Route::get('/new', 'Questions\QuestionController@new')->name('question.new');
Route::post('/new', 'Questions\QuestionController@store');

// Edit question
Route::get('/edit/{question}', 'Questions\QuestionController@edit')->name('question.edit');
Route::post('/edit/{question}', 'Questions\QuestionController@update');

// Delete question
Route::get('/delete/{question}', 'Questions\QuestionController@delete')->name('question.delete');
Route::post('/delete/{question}', 'Questions\QuestionController@destroy');

/* List categories */
Route::get('/category/all', 'Categories\CategoryController@index')->name('category.all');

// New category
Route::get('/category/new', 'Categories\CategoryController@new')->name('category.new');
Route::post('/category/new', 'Categories\CategoryController@store');

// Edit category
Route::get('/category/edit/{question}', 'Categories\CategoryController@edit')->name('category.edit');
Route::post('/category/edit/{question}', 'Categories\CategoryController@update');

// Delete category
Route::get('/category/delete/{question}', 'Categories\CategoryController@delete')->name('category.delete');
Route::post('/category/delete/{question}', 'Categories\CategoryController@destroy');

/* Settings */
Route::get('/settings', 'Settings\SettingsController@index')->name('settings');
Route::post('/settings', 'Settings\SettingsController@store');
