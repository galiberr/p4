<?php

/*
 * Authentication/registration
 */
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/register', 'UserController@getRegister');
Route::post('/register', 'UserController@postRegister');
Route::get('/logout', 'Auth\AuthController@logout');

/*
 * Routes accessible with and without authentication
 * (index and event search)
 */
Route::get('/', 'UserController@getIndex');
Route::get('/events/search', 'EventController@getSearch');
Route::post('/events/search', 'EventController@postSearch');

/*
 * Routes requiring authentication
 */
Route::group(['middleware' => 'auth'], function () {
        
        /*
         * User CRUD functionality
         */
        Route::get('/users/{id}/edit', 'UserController@getEdit');
        Route::post('/users/{id}/edit', 'UserController@postEdit');
        Route::get('/users/editMyProfile', 'UserController@getEditMyProfile');
        Route::post('/users/editMyProfile', 'UserController@postEditMyProfile');
        Route::get('/users/confirm-delete/{id}', 'UserController@getConfirmDelete');
        Route::get('/users/delete/{id}', 'UserController@getDelete');
        // Detail page includes functionality to post a KJ rating
        Route::get('/users/{id}', 'UserController@getDetail');
        Route::post('/users/{id}', 'UserController@postDetail');
        /*
         * Event CRUD functionality
         */
        Route::get('/events/create', 'EventController@getCreate');
        Route::post('/events/create', 'EventController@postCreate');
        Route::get('/events/{id}/edit', 'EventController@getEdit');
        Route::post('/events/{id}/edit', 'EventController@postEdit');
        Route::get('/events/myEvents', 'EventController@getShowMyEvents');
        Route::get('/events/confirm-delete/{id}', 'EventController@getConfirmDelete');
        Route::get('/events/delete/{id}', 'EventController@getDelete');
        // Detail page includes functionality to add an event post
        Route::get('/events/{id}', 'EventController@getDetail');
        Route::post('/events/{id}', 'EventController@postDetail');
        /*
         * Locale-related functionality (locales created automatically if
         * necessary when KJ creates an event)
         */
        Route::get('/locales/search', 'LocaleController@getSearch');
        Route::post('/locales/search', 'LocaleController@postSearch');
        // Detail page includes functionality to post a locale rating
        Route::get('/locales/{id}', 'LocaleController@getDetail');
        Route::post('/locales/{id}', 'LocaleController@postDetail');
});
