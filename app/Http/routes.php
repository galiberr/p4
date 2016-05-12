<?php

/*
 * Authentication/registration
 */
Route::get('/login', 'Auth\AuthController@getLogin');
Route::post('/login', 'Auth\AuthController@postLogin');
Route::get('/register', 'UserController@getRegister');
Route::post('/register', 'UserController@postRegister');
// Route::get('/register', 'Auth\AuthController@getRegister');
// Route::post('/register', 'Auth\AuthController@postRegister');
Route::get('/logout', 'Auth\AuthController@logout');

Route::get('/googleMapsTest2', function () {
        return view('googleMapsTest2');
});

/*
 * Routes accessible with and without authentication
 * (index and event search)
 */
Route::get('/', 'EventController@getSearch');
Route::get('/events/search', 'EventController@getSearch');
Route::post('/events/search', 'EventController@postSearch');

/*
 * Routes requiring authentication
 */
Route::group(['middleware' => 'auth'], function () {

        /*
         * User-related functionality
         */
        Route::get('/users/search', 'UserController@getSearch');
        Route::post('/users/search', 'UserController@postSearch');
        Route::get('/users/{id}/edit', 'UserController@getEdit');
        Route::post('/users/{id}/edit', 'UserController@postEdit');
        // Detail page includes functionality to post a KJ rating
        Route::get('/users/2', 'UserController@getDetail2');
        Route::post('/users/2', 'UserController@postDetail2');
        Route::get('/users/{id}', 'UserController@getDetail');
        Route::post('/users/{id}', 'UserController@postDetail');

        /*
         * Event-related functionality
         */
        Route::get('/events/create', 'EventController@getCreate');
        Route::post('/events/create', 'EventController@postCreate');
        Route::get('/events/create2', 'EventController@getCreate2');
        Route::post('/events/create2', 'EventController@postCreate2');
        Route::get('/events/create3', 'EventController@getCreate3');
        Route::post('/events/create3', 'EventController@postCreate3');
        Route::get('/events/{id}/edit', 'EventController@getEdit');
        Route::post('/events/{id}/edit', 'EventController@postEdit');
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
