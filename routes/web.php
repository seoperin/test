<?php

Route::get('/', 'MainController@index')
    ->name('home');

Route::post('/addVacancy', 'MainController@addVacancy')
    ->middleware(['auth'])
    ->name('addVacancy');

Auth::routes();

Route::group(['as' => 'admin.', 'namespace' => 'Admin', 'prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {

    Route::get('/', 'AdminController@dashboard')
        ->name('dashboard');

    Route::get('/vacancies/{id}', 'AdminController@showVacancy')
        ->name('showVacancy');

    Route::post('/moderate/{id}', 'AdminController@moderate')
        ->name('moderate');

});
