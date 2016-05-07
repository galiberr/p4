<?php

Route::get('/googleMapsTest2', function () {
    return view('googleMapsTest2');
});

Route::group(['middleware' => ['web']], function () {
        Route::get('/', function () {
            return view('welcome');
        });

        // Add login, logout
        /*
         * User-related functionality
         */
        Route::get('/register', 'UserController@getCreate');
        Route::post('/register', 'UserController@postCreate');
        Route::get('/users/search', 'UserController@getSearch');
        Route::post('/users/search', 'UserController@postSearch');
        Route::get('/users/{id}/edit', 'UserController@getEdit');
        Route::post('/users/{id}/edit', 'UserController@postEdit');
        // Detail page includes functionality to post a KJ rating
        Route::get('/users/{id}', 'UserController@getDetail');
        Route::post('/users/{id}', 'UserController@postDetail');

        /*
         * Event-related functionality
         */
        Route::get('/events/create', 'EventController@getCreate');
        Route::post('/events/create', 'EventController@postCreate');
        Route::get('/events/search', 'EventController@getSearch');      // functionality just on index?
        Route::post('/events/search', 'EventController@postSearch');     // functionality just on index?
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