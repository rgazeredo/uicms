<?php

Route::group(['prefix' => 'uiadmin/uiprofile', 'namespace' => 'Modules\UiProfile\Http\Controllers'], function()
{
	Route::get('/', ['uses' => 'UiProfileController@index']);
	Route::get('/index', ['uses' => 'UiProfileController@index']);
	Route::any('/create', ['uses' => 'UiProfileController@create']);
	Route::any('/edit/{id}', ['uses' => 'UiProfileController@edit']);
	Route::any('/delete/{id}', ['uses' => 'UiProfileController@delete']);
	Route::any('/permission/{id}', ['uses' => 'UiProfileController@permission']);
});