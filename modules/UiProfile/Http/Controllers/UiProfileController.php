<?php namespace Modules\Uiprofile\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Uiadmin\Entities\UiAcl;
use Modules\Uiprofile\Entities\UiProfile;
use Modules\Uimodule\Entities\UiModule;
use Modules\Uimodule\Entities\UiModuleAction;

class UiProfileController extends Controller {
	
	private $_dataView = array(
        'module_title'  => 'Perfil de acesso',
        'module_link'   => 'uiadmin/uiprofile',
        'module_action' => '',
    );

    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->_dataView['ui_admin_auth'] = $request->session()->get('ui_admin_auth');
    }
    
    public function index()
    {
    	$ui_profiles = UiProfile::all();

        $this->_dataView['ui_profiles'] = $ui_profiles;
    	
    	return view('uiprofile::index', $this->_dataView);
    }

    public function create()
    {
        $params = \Input::all();

        if(!empty($params))
        {
            $validator = \Validator::make(
                $params,
                array(
                    'name' => array('required')
                )
            );

            if (!$validator->fails())
            {
                $ui_profile = new UiProfile();
                $ui_profile->fill($params);
                $ui_profile->root = 0;
                if($ui_profile->save())
                    return \Redirect::to('uiadmin/uiprofile');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_profile = new UiProfile();
        $this->_dataView['ui_profile'] = $ui_profile;

        $this->_dataView['module_action'] = 'Adicionar';

        return view('uiprofile::form', $this->_dataView);   
    }

    public function edit($id)
    {
        if(!empty($id))
        {
            $ui_profile = new UiProfile();
            $ui_profile = $ui_profile->find($id);
            $this->_dataView['ui_profile'] = $ui_profile;
        }

        $params = \Input::all();

        if(!empty($params))
        {
            $validator = \Validator::make(
                $params,
                array(
                    'name' => array('required')
                )
            );

            if (!$validator->fails())
            {
                $ui_profile->fill($params);
                if($ui_profile->save())
                    return \Redirect::to('uiadmin/uiprofile');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_profiles = new UiProfile();
        $ui_profiles = $ui_profiles->all()->toArray();
        $this->_dataView['ui_profiles'] = $ui_profiles;

        $this->_dataView['module_action'] = 'Editar';

        return view('uiprofile::form', $this->_dataView);   
    }

    public function delete($id)
    {
        if(!empty($id))
        {
            $ui_profile = new UiProfile();
            $ui_profile = $ui_profile->find($id);
            $this->_dataView['ui_profile'] = $ui_profile;
        }

        $params = \Input::all();

        if(!empty($params))
        {
            if($ui_profile->delete())
                return \Redirect::to('uiadmin/uiprofile');
        }

        $this->_dataView['module_action'] = 'Remover';

        return view('uiprofile::delete', $this->_dataView);
    }

    public function permission($id)
    {
        if(!empty($id))
        {
            $ui_profile = new UiProfile();
            $ui_profile = $ui_profile->find($id);
            $this->_dataView['ui_profile'] = $ui_profile;
        }

        $params = \Input::all();

        if(!empty($params))
        {
            foreach ($params['permissions'] as $module => $actions) {
                
                //Recupera o modulo selecionado
                $ui_module = UiModule::where('module', '=', $module)->first();

                //Apaga todas as permissões do módulo selecionado
                \DB::table('ui_acl')->where('ui_profile_id', '=', $ui_profile->id)
                                    ->whereRaw('ui_module_action_id IN (SELECT id FROM ui_module_action WHERE ui_module_id = '. $ui_module->id .')')
                                    ->delete();
                
                foreach ($actions as $ui_module_action_id => $action) {
                    $ui_acl = new UiAcl();
                    $ui_acl->ui_profile_id = $ui_profile->id;
                    $ui_acl->ui_module_action_id = $ui_module_action_id;
                    $ui_acl->save();
                }

            }
            
            return \Redirect::to('uiadmin/uiprofile');
        }

        $ui_modules = UiModule::all();

        $ar_ui_modules = array();

        foreach ($ui_modules as $ui_module) 
        {
            $ui_module_action = UiModuleAction::where('ui_module_id', '=', $ui_module->id)->get();

            $ar_module_action = array();

            foreach ($ui_module_action as $module_action) 
            {
                $ob_module_action = (object) $module_action->toArray();
                $ui_acl = UiAcl::where('ui_profile_id', '=', $ui_profile->id)
                               ->where('ui_module_action_id', '=', $module_action->id)
                               ->first();

                if(!empty($ui_acl))
                    $ob_module_action->exists = true;
                else
                    $ob_module_action->exists = false;

                array_push($ar_module_action, $ob_module_action);
            }

            $ob_ui_mobile = (object) $ui_module->toArray();
            $ob_ui_mobile->actions = $ar_module_action;

            array_push($ar_ui_modules, $ob_ui_mobile);
        }

        $ui_modules = $ar_ui_modules;

        $this->_dataView['ui_modules'] = $ui_modules;
        $this->_dataView['module_action'] = 'Permissões';

        return view('uiprofile::permission', $this->_dataView);
    }
	
}