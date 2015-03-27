<?php

Route::get('/', 'MainController@index');

Route::get('home', 'HomeController@index');

Route::get('login', 'HomeController@login');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);
