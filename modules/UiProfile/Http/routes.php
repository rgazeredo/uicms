<?php

Route::group(['prefix' => 'uiprofile', 'namespace' => 'Modules\UiProfile\Http\Controllers'], function()
{
	Route::get('/', 'UiProfileController@index');
});