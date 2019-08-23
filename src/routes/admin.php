<?php

Route::get('/', [
    'as'   => 'admin',
    'uses' => 'Admin\IndexController@index'
]);