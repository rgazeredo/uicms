<?php namespace Modules\Uimodule\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class UiModuleController extends Controller {
	
	public function index()
	{
		return view('uimodule::index');
	}
	
}