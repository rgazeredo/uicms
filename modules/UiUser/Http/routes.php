<?php

Route::group(['prefix' => 'uiuser', 'namespace' => 'Modules\UiUser\Http\Controllers'], function()
{
	Route::get('/', 'UiUserController@index');
});