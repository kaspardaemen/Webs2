<?php

Route::get('/', 'MainController@index');

Route::get('home', 'MainController@index');

Route::get('login', 'MainController@login');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
