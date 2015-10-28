<?php

Route::group(['prefix' => 'uimenu', 'namespace' => 'Modules\UiMenu\Http\Controllers'], function()
{
	Route::get('/', 'UiMenuController@index');
});