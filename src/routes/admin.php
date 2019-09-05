<?php

Route::get('/', [
    'as'   => 'admin',
    'uses' => 'Admin\IndexController@index'
]);

Route::resource('users', 'Admin\UsersController', ['as' => 'admin'])->except([
    'show'
]);

Route::group(['middleware' => ['dev'], 'prefix' => 'dev'], function () {
    include('dev.php');
});