<?php namespace Modules\Uimodule\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Uimodule\Entities\UiModule;
use Modules\Uimodule\Entities\UiModuleAction;

class UiModuleController extends Controller {
	
	private $_dataView = array(
        'module_title'  => 'Módulo',
        'module_link'   => 'uiadmin/uimodule',
        'module_action' => '',
    );

    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->_dataView['ui_admin_auth'] = $request->session()->get('ui_admin_auth');
    }
    
    public function index()
    {
    	$ui_modules = UiModule::all();

        $this->_dataView['ui_modules'] = $ui_modules;
    	
    	return view('uimodule::index', $this->_dataView);
    }

    public function create()
    {
        $params = \Input::all();

        if(!empty($params))
        {
            $validator = \Validator::make(
                $params,
                array(
                    'name' => array('required'),
                    'module' => array('required')
                )
            );

            if (!$validator->fails())
            {
                $params['route'] = 'uiadmin/'. strtolower($params['module']);

                $ui_module = new UiModule();
                $ui_module->fill($params);
                if($ui_module->save())
                    return \Redirect::to('uiadmin/uimodule');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_modules_exists = UiModule::all();

        $modules = app('modules');

        $ui_modules = array();

        foreach ($modules->enabled() as $module_name => $module) {
            $ob_module = (object) null;
            $ob_module->id = 0;
            $ob_module->name = $module_name;
            $ob_module->exists = false;

            foreach ($ui_modules_exists as $module_exists) {
                if($module_name == $module_exists->module) {
                    $ob_module->exists = true;
                    break;
                }
            }
            
            array_push($ui_modules, $ob_module);
        }
        
        $this->_dataView['ui_modules'] = $ui_modules;

        $ui_module = new UiModule();
        $this->_dataView['ui_module'] = $ui_module;

        $this->_dataView['module_action'] = 'Adicionar';

        return view('uimodule::form', $this->_dataView);   
    }

    public function edit($id)
    {
        if(!empty($id))
        {
            $ui_module = new UiModule();
            $ui_module = $ui_module->find($id);
            $this->_dataView['ui_module'] = $ui_module;
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
                $params['route'] = 'uiadmin/'. strtolower($ui_module->module);

                $ui_module->fill($params);
                if($ui_module->save())
                    return \Redirect::to('uiadmin/uimodule');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_modules_exists = UiModule::all();

        $modules = app('modules');

        $ui_modules = array();

        foreach ($modules->enabled() as $module_name => $module) {
            $ob_module = (object) null;

            if(strtolower($ui_module->module) == strtolower($module_name))
                $ob_module->id = $ui_module->id;
            else 
                $ob_module->id = 0;

            $ob_module->name = $module_name;
            $ob_module->exists = false;

            foreach ($ui_modules_exists as $module_exists) {
                if($module_name == $module_exists->module) {
                    $ob_module->exists = true;
                    break;
                }
            }
            
            array_push($ui_modules, $ob_module);
        }
        
        $this->_dataView['ui_modules'] = $ui_modules;

        $this->_dataView['module_action'] = 'Editar';

        return view('uimodule::form', $this->_dataView);   
    }

    public function delete($id)
    {
        if(!empty($id))
        {
            $ui_module = new UiModule();
            $ui_module = $ui_module->find($id);
            $this->_dataView['ui_module'] = $ui_module;
        }

        $params = \Input::all();

        if(!empty($params))
        {
            $ui_module_actions = UiModuleAction::where('ui_module_id', '=', $ui_module->id)->get();

            foreach ($ui_module_actions as $ui_module_action) {
                $ui_module_action->delete();
            }

            if($ui_module->delete())
                return \Redirect::to('uiadmin/uimodule');
        }

        $this->_dataView['module_action'] = 'Remover';

        return view('uimodule::delete', $this->_dataView);
    }

    public function actions(Request $request, $id)
    {
        if(!empty($id))
        {
            $ui_module = new UiModule();
            $ui_module = $ui_module->find($id);
        }

        $params = \Input::all();

        if(!empty($params))
        {
            //Recuperar os nomes das ações e realiza o tratamento para gravar
            foreach ($params['name'] as $module_id => $names)
            {
                foreach ($names as $key => $name)
                {
                    //Verificar se o nome da ação foi informado
                    if(!empty($name))
                    {
                        //Verifica se o registra já esta cadastrado
                        $ui_module_action = UiModuleAction::where('ui_module_id', '=', $module_id)
                                            ->where('action', '=', $params['action'][$module_id][$key])
                                            ->first();

                        if(!$ui_module_action)
                            $ui_module_action = new UiModuleAction();

                        //Configura o model para gravar as informações
                        $ui_module_action->ui_module_id = $module_id;
                        $ui_module_action->name = $name;
                        $ui_module_action->link = $params['link'][$module_id][$key];
                        $ui_module_action->action = $params['action'][$module_id][$key];
                        $ui_module_action->save();
                    }
                }
            }

            return \Redirect::to('uiadmin/uimodule');
        }

        $methods_ignored = array(
            '__construct',
            'middleware',
            'beforeFilter',
            'afterFilter',
            'parseFilter',
            'registerClosureFilter',
            'registerInstanceFilter',
            'isInstanceFilter',
            'forgetBeforeFilter',
            'forgetAfterFilter',
            'removeFilter',
            'getMiddleware',
            'getBeforeFilters',
            'getAfterFilters',
            'getRouter',
            'setRouter',
            'callAction',
            'missingMethod',
            '__call',
            'dispatch',
            'dispatchFromArray',
            'dispatchFrom',
            'validate',
            'validateWithBag',
            'throwValidationException',
            'buildFailedValidationResponse',
            'formatValidationErrors',
            'getRedirectUrl',
            'getValidationFactory',
            'withErrorBag',
            'errorBag',
        );

        //Configura o nome do controller
        $ui_controller_name = "Modules\\$ui_module->module\Http\Controllers\\$ui_module->module"."Controller";

        //Instacia o controller
        $ui_module_controller = new $ui_controller_name($request);

        //Recupera todos os metodos do controlador informado
        $controller_actions = get_class_methods($ui_module_controller);

        //Lista de controllers da aplicacao
        $ui_module_controller_actions = array();

        foreach ($controller_actions as $controller_action) 
        {
            if(!in_array($controller_action, $methods_ignored))
            {
                $ui_module_action = UiModuleAction::where('ui_module_id', '=', $ui_module->id)
                                    ->where('action', '=', $controller_action)
                                    ->first();

                $ob_ui_module_action = (object) null;


                if($ui_module_action)
                {
                    $ob_ui_module_action = (object) $ui_module_action->toArray();
                } else {
                    $ob_ui_module_action->id = '';
                    $ob_ui_module_action->name = $controller_action;
                    $ob_ui_module_action->link = $ui_module->route .'/'. $controller_action;
                    $ob_ui_module_action->action = $controller_action;
                }
                
                array_push($ui_module_controller_actions, $ob_ui_module_action);
            }
        }
        
        $this->_dataView['ui_module_controller_actions'] = $ui_module_controller_actions;
        $this->_dataView['ui_module'] = $ui_module;
        $this->_dataView['module_action'] = 'Ações';

        return view('uimodule::actions', $this->_dataView);
    }

    public function actionsdelete($id)
    {
        if(!empty($id))
        {
            $ui_module_action = new UiModuleAction();
            $ui_module_action = $ui_module_action->find($id);

            //Recupera o id do módulo
            $module_id = $ui_module_action->ui_module_id;

            //Releta o registro informado e redireciona para a página de ações
            if($ui_module_action->delete())
                return \Redirect::to('uiadmin/uimodule/actions/'.$module_id);
        }
    }
	
}