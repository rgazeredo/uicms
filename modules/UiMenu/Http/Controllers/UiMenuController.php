<?php namespace Modules\Uimenu\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class UiMenuController extends Controller {
	
	public function index()
	{
		return view('uimenu::index');
	}
	
}