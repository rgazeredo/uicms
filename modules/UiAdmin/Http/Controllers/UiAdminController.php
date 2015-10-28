<?php namespace Modules\Uiadmin\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class UiAdminController extends Controller {
	
	public function index()
	{
		return view('uiadmin::index');
	}
	
}