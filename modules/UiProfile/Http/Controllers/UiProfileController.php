<?php namespace Modules\Uiprofile\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class UiProfileController extends Controller {
	
	public function index()
	{
		return view('uiprofile::index');
	}
	
}