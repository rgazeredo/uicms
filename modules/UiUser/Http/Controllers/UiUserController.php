<?php namespace Modules\Uiuser\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class UiUserController extends Controller {
	
	public function index()
	{
		return view('uiuser::index');
	}
	
}