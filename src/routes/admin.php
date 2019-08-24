<?php

Route::get('/', [
    'as'   => 'admin',
    'uses' => 'Admin\IndexController@index'
]);

Route::group(['middleware' => ['dev'], 'prefix' => 'dev'], function () {
    include('dev.php');
});