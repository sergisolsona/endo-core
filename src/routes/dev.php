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

Route::post('/endo-setting', [
    'as' => 'admin.dev.endo-setting',
    'uses' => 'Admin\EndoSettingsController@setSetting'
]);

Route::resource('languages', 'Admin\LanguagesController', ['as' => 'admin.dev']);