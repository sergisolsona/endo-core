<?php

Route::get('/', [
    'uses' => 'IndexController@index'
]);

Route::group(['prefix' => '{locale}'], function () {
    include('routes.php');
});