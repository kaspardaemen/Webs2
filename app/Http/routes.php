<?php

//Route::get('/', 'MainController@index');
Route::get('/', array(
    'as' => 'home',
    'uses' => 'HomeController@home'
));

Route::get('/about', array(
   'as' => 'about',
   'uses' => 'MenuController@about'
));

Route::get('/services', array(
   'as' => 'services',
   'uses' => 'MenuController@services'
));

Route::get('/contact', array(
   'as' => 'contact',
   'uses' => 'MenuController@contact'
));

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' =>  'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

/*
# Nog niet ingelogde groep
 
Route::group(array('before' => 'guest'), function (){
    
    # csrf protection??
    
    Route::group(array('before' => 'csrf'), function (){

    });

    
    # account aanmaken post    
    Route::post('/account/create', array(
        'as' => 'account-create-post',
        'uses' => 'AccountController@postCreate'
    ));

    
    # account aanmaken get    
    Route::get('/account/create', array(
        'as' => 'account-create',
        'uses' => 'AccountController@getCreate'
    ));
});
*/
