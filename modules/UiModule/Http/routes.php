<?php

Route::group(['prefix' => 'uiadmin/uimodule', 'namespace' => 'Modules\UiModule\Http\Controllers'], function()
{
	Route::get('/', ['uses' => 'UiModuleController@index']);
	Route::get('/index', ['uses' => 'UiModuleController@index']);
	Route::any('/create', ['uses' => 'UiModuleController@create']);
	Route::any('/edit/{id}', ['uses' => 'UiModuleController@edit']);
	Route::any('/delete/{id}', ['uses' => 'UiModuleController@delete']);
	Route::any('/actions/{id}', ['uses' => 'UiModuleController@actions']);
	Route::any('/actionsdelete/{id}', ['uses' => 'UiModuleController@actionsdelete']);
});