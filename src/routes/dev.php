<?php
/**
 * Created by PhpStorm.
 * User: sergisolsona
 * Date: 24/08/2019
 * Time: 18:20
 */

Route::get('/', [
    'as'   => 'admin.dev',
    'uses' => 'Admin\DevIndexController@index'
]);


Route::resource('languages', 'Admin\LanguagesController', ['as' => 'admin.dev']);