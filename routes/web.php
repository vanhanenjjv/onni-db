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

Route::prefix('category')->group(function () {
    /* List categories */
    Route::get('all', 'Categories\CategoryController@index')->name('category.all');

// New category
    Route::get('new', 'Categories\CategoryController@new')->name('category.new');
    Route::post('new', 'Categories\CategoryController@store');

// Edit category
    Route::get('edit/{question}', 'Categories\CategoryController@edit')->name('category.edit');
    Route::post('edit/{question}', 'Categories\CategoryController@update');

// Delete category
    Route::get('delete/{question}', 'Categories\CategoryController@delete')->name('category.delete');
    Route::post('delete/{question}', 'Categories\CategoryController@destroy');
});

/* Settings */
Route::prefix('settings')->group(function () {
    Route::get('/', 'Settings\SettingsController@index')->name('settings.profile');
    Route::post('/', 'Settings\SettingsController@store');

    Route::get('password', 'Settings\PasswordController@index')->name('settings.password');
    Route::post('password', 'Settings\PasswordController@store');
});


