<?php

Route::group(['prefix' => 'uiadmin/uiuser', 'namespace' => 'Modules\UiUser\Http\Controllers'], function()
{
	Route::get('/', 'UiUserController@index');
	Route::get('/index', 'UiUserController@index');
	Route::any('/create', ['uses' => 'UiUserController@create']);
	Route::any('/edit/{id}', ['uses' => 'UiUserController@edit']);
	Route::any('/delete/{id}', ['uses' => 'UiUserController@delete']);
});