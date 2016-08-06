<?php

Route::get('/', function () {
    return view('welcome');
});

Route::auth();

Route::get('', [
    'as' => 'home', 'uses' => 'HomeController@index'
]);

// Routes that requires login authentication
Route::group(['middleware' => 'auth'], function () {

    // Admin related routes
    Route::group(['namespace' => 'Admin', 'prefix' => 'admin'], function() {

        // Blog related routes
        Route::group(['namespace' => 'Blog', 'prefix' => 'blog'], function() {
            Route::get('', [
                'as' => 'admin.blog.index', 'uses' => 'BlogController@index'
            ]);
            Route::get('create', [
                'as' => 'admin.blog.create', 'uses' => 'BlogController@create'
            ]);
            Route::post('store', [
                'as' => 'admin.blog.store',  'uses' => 'BlogController@store'
            ]);
            Route::get('edit/{id}', [
                'as' => 'admin.blog.edit',   'uses' => 'BlogController@edit'
            ]);
            Route::post('update/{id}', [
                'as' => 'admin.blog.update',   'uses' => 'BlogController@update'
            ]);
            Route::delete('destroy/{id}', [
                'as' => 'admin.blog.destroy',   'uses' => 'BlogController@destroy'
            ]);
        });
    });
});