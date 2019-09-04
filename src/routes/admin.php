<?php

Route::get('/', [
    'as'   => 'admin',
    'uses' => 'Admin\IndexController@index'
]);

Route::resource('users', 'Admin\UsersController', ['as' => 'admin'])->except([
    'show',
    'destroy'
]);

Route::group(['middleware' => ['dev'], 'prefix' => 'dev'], function () {
    include('dev.php');
});