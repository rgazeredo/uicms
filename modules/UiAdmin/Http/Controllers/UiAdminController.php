<?php namespace Modules\Uiadmin\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Uiuser\Entities\UiUser;
use Modules\UiMenu\Entities\UiMenu;
use Modules\UiMenu\Entities\UiMenuItem;

class UiAdminController extends Controller {
	
	private $_dataView = array(
        'module_title'  => 'Dashboard',
        'module_link'   => 'uiadmin',
        'module_action' => '',
    );

	public function __construct(Request $request)
    {
    	$this->middleware('auth', ['except' => ['login']]);

        $this->_dataView['ui_admin_auth'] = $request->session()->get('ui_admin_auth');
    }

	public function index()
	{
		return view('uiadmin::index', $this->_dataView);
	}
	
	public function login(Request $request){

        $params = \Input::all();

        if(!empty($params))
        {
            $ui_user = UiUser::where('email', '=', $params['email'])
                       ->where('password', '=', md5($params['password']))
                       ->first();

            if($ui_user)
            {
            	$ui_admin_auth = (object) $ui_user->toArray();

            	$ui_menu = UiMenu::where('admin', '=', 1)->first();

            	$ui_menu_items = UiMenuItem::where('ui_menu_id', '=', $ui_menu->id)
                                   ->whereNull('parent_id')
                                   ->orderBy('position')
                                   ->get();

        		$ui_admin_auth->admin_menu = $ui_menu->adminMenu($ui_menu_items);

                $request->session()->set('ui_admin_auth', $ui_admin_auth);
                return \Redirect::to('uiadmin');
            } else {
                $this->_dataView['ui_errors'] = array('Usuário e/ou senha inválido!');
            }
        }

    	return view('uiadmin::login', $this->_dataView);
    }

    public function logout(Request $request){

	    $request->session()->flush();

	    return \Redirect::to('uiadmin/login');
    }
}