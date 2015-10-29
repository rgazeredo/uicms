<?php namespace Modules\Uiuser\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Uiuser\Entities\UiUser;
use Modules\Uiprofile\Entities\UiProfile;

class UiUserController extends Controller {
	
	private $_dataView = array(
        'module_title'  => 'Usuário',
        'module_link'   => 'uiadmin/uiuser',
        'module_action' => '',
    );

    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->_dataView['ui_admin_auth'] = $request->session()->get('ui_admin_auth');
    }

	public function index()
	{
		$ui_users = UiUser::all();

        $this->_dataView['ui_users'] = $ui_users;
    	
		return view('uiuser::index', $this->_dataView);
	}
	
	public function create()
    {
        $params = \Input::all();

        if(!empty($params))
        {
            $validator = \Validator::make(
                $params,
                array(
                    'ui_profile_id' => array('required'),
                    'name' => array('required'),
                    'email' => array('required'),
                    'password' => array('required')
                )
            );

            if (!$validator->fails())
            {
                $params['password'] = md5($params['password']);

                $ui_user = new UiUser();
                $ui_user->fill($params);
                if($ui_user->save())
                    return \Redirect::to('uiadmin/uiuser');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_user = new UiUser();

        $this->_dataView['ui_user'] = $ui_user;

        $ui_profiles = new UiProfile;

        $this->_dataView['ui_profiles'] = $ui_profiles->getAllSelect();

        $this->_dataView['module_action'] = 'Adicionar';

        return view('uiuser::form', $this->_dataView);   
    }

    public function edit($id)
    {
        if(!empty($id))
        {
            $ui_user = new UiUser();
            $ui_user = $ui_user->find($id);
            $this->_dataView['ui_user'] = $ui_user;
        }

        $params = \Input::all();

        if(!empty($params))
        {
            $validator = \Validator::make(
                $params,
                array(
                    'ui_profile_id' => array('required'),
                    'name' => array('required'),
                    'email' => array('required')
                )
            );

            if (!$validator->fails())
            {
                if(!empty($params['password']))
                    $params['password'] = md5($params['password']);
                else
                    $params['password'] = $ui_user->password;

                if(empty($params['active']))
                    $params['active'] = 0;

                $ui_user->fill($params);
                if($ui_user->save())
                    return \Redirect::to('uiadmin/uiuser');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_profiles = new UiProfile;

        $this->_dataView['ui_profiles'] = $ui_profiles->getAllSelect();

        $this->_dataView['module_action'] = 'Editar';

        return view('uiuser::form', $this->_dataView);   
    }

    public function delete($id)
    {
        if(!empty($id))
        {
            $ui_user = new UiUser();
            $ui_user = $ui_user->find($id);
            $this->_dataView['ui_user'] = $ui_user;
        }

        $params = \Input::all();

        if(!empty($params))
        {
            if($ui_user->delete())
                return \Redirect::to('uiadmin/uiuser');
        }

        $this->_dataView['module_action'] = 'Remover';

        return view('uiuser::delete', $this->_dataView);
    }
}