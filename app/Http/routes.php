<?php

Route::get('/', 'MainController@index');

Route::get('home', 'MainController@index');

Route::get('login', 'MainController@login');

Route::get('admin', 'AdminController@index');
/*
| Nog niet ingelogde groep
 */
Route::group(array('before' => 'guest'), function (){
    /*
    | csrf protection??
    */
    Route::group(array('before' => 'csrf'), function (){

    });

    /*
    | account aanmaken post
    */
    Route::post('/account/create', array(
        'as' => 'account-create-post',
        'uses' => 'AccountController@postCreate'
    ));


    /*
    | account aanmaken get
    */
    Route::get('/account/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));
});

