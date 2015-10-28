<?php

Route::group(['prefix' => 'uimodule', 'namespace' => 'Modules\UiModule\Http\Controllers'], function()
{
	Route::get('/', 'UiModuleController@index');
});