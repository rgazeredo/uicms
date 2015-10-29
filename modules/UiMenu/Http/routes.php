<?php

Route::group(['prefix' => 'uiadmin/uimenu', 'namespace' => 'Modules\UiMenu\Http\Controllers'], function()
{
	Route::get('/', ['uses' => 'UiMenuController@index']);
	Route::get('/index', ['uses' => 'UiMenuController@index']);
	Route::any('/create', ['uses' => 'UiMenuController@create']);
	Route::any('/edit/{id}', ['uses' => 'UiMenuController@edit']);
	Route::any('/delete/{id}', ['uses' => 'UiMenuController@delete']);
	Route::any('/items/{id}', ['uses' => 'UiMenuController@items']);
});