<?php

Route::group(['prefix' => 'uiadmin', 'namespace' => 'Modules\UiAdmin\Http\Controllers'], function()
{
	Route::get('/', ['uses' => 'UiAdminController@index']);
	Route::get('/index', ['uses' => 'UiAdminController@index']);
	Route::any('/login', ['uses' => 'UiAdminController@login']);
	Route::get('/logout', ['uses' => 'UiAdminController@logout']);
	Route::post('/uiajax/uipopulatecombobox', ['uses' => 'UiAjaxController@uipopulatecombobox']);
	Route::post('/uiajax/uimodalsave', ['uses' => 'UiAjaxController@uimodalsave']);
	Route::post('/uiajax/uifind', ['uses' => 'UiAjaxController@uifind']);
	Route::post('/uiajax/uimodalremove', ['uses' => 'UiAjaxController@uimodalremove']);
});