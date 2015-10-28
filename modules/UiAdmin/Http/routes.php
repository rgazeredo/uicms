<?php

Route::group(['prefix' => 'uiadmin', 'namespace' => 'Modules\UiAdmin\Http\Controllers'], function()
{
	Route::get('/', 'UiAdminController@index');
});