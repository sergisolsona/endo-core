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

Route::get('/settings', [
    'as'   => 'admin.dev.settings',
    'uses' => 'Admin\SettingsController@index'
]);

Route::resource('post-types', 'Admin\PostTypesController', ['as' => 'admin.dev'])->except([
    'show'
]);

Route::resource('custom-fields', 'Admin\CustomFieldsController', ['as' => 'admin.dev'])->except([
    'show'
]);

Route::resource('languages', 'Admin\LanguagesController', ['as' => 'admin.dev'])->except([
    'show',
    'destroy'
]);

Route::post('/languages/change/{id}', 'Admin\LanguagesController@change')->name('admin.dev.languages.change');