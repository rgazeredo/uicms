<?php namespace Modules\Uimenu\Http\Controllers;

use Illuminate\Http\Request;
use Pingpong\Modules\Routing\Controller;
use Modules\Uimenu\Entities\UiMenu;
use Modules\Uimenu\Entities\UiMenuItem;
use Modules\Uimodule\Entities\UiModule;

class UiMenuController extends Controller {
	
	private $_dataView = array(
        'module_title'  => 'Menu',
        'module_link'   => 'uiadmin/uimenu',
        'module_action' => '',
    );

    public function __construct(Request $request)
    {
        $this->middleware('auth');

        $this->_dataView['ui_admin_auth'] = $request->session()->get('ui_admin_auth');
    }

    public function index()
    {
    	$ui_menus = UiMenu::all();

        $this->_dataView['ui_menus'] = $ui_menus;
    	
    	return view('uimenu::index', $this->_dataView);
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
                $ui_menu = new UiMenu();
                $ui_menu->fill($params);
                if($ui_menu->save())
                    return \Redirect::to('uiadmin/uimenu');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_menu = new UiMenu();
        $this->_dataView['ui_menu'] = $ui_menu;

        $this->_dataView['module_action'] = 'Adicionar';

        return view('uimenu::form', $this->_dataView);   
    }

    public function edit($id)
    {
        if(!empty($id))
        {
            $ui_menu = new UiMenu();
            $ui_menu = $ui_menu->find($id);
            $this->_dataView['ui_menu'] = $ui_menu;
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
                $ui_menu->fill($params);
                if($ui_menu->save())
                    return \Redirect::to('uiadmin/uimenu');
            } else {
                $messages = $validator->messages();
                $this->_dataView['messages_errors'] = $messages->all();
            }
        }

        $ui_menus = new UiMenu();
        $ui_menus = $ui_menus->all()->toArray();
        $this->_dataView['ui_menus'] = $ui_menus;

        $this->_dataView['module_action'] = 'Editar';

        return view('uimenu::form', $this->_dataView);   
    }

    public function delete($id)
    {
        if(!empty($id))
        {
            $ui_menu = new UiMenu();
            $ui_menu = $ui_menu->find($id);
            $this->_dataView['ui_menu'] = $ui_menu;
        }

        $params = \Input::all();

        if(!empty($params))
        {
            if($ui_menu->delete())
                return \Redirect::to('uiadmin/uimenu');
        }

        $this->_dataView['module_action'] = 'Remover';

        return view('uimenu::delete', $this->_dataView);
    }

    public function items(Request $request, $id)
    {
        if(!empty($id))
        {
            $ui_menu = new UiMenu();
            $ui_menu = $ui_menu->find($id);
        }

        $this->_dataView['ui_menu'] = $ui_menu;

        $params = \Input::all();

        if(!empty($params))
        {
            $menuserialize = json_decode($params['menuserialize']);

            if(!empty($menuserialize))
            {
                \DB::update('UPDATE ui_menu_item SET parent_id = NULL WHERE ui_menu_id = '. $ui_menu->id);

                $ui_menu_item = new UiMenuItem();
                $ui_menu_item->order($menuserialize);

                $this->_dataView['message_success'] = 'Ordenação salva com sucesso!';
            }
        }

        $ui_modules = UiModule::all();
        $ar_ui_modules = array('' => 'Selecione...');

        foreach ($ui_modules as $ui_module) 
        {
            $ar_ui_modules[$ui_module->id] = $ui_module->name;
        }

        $ui_menu_items = UiMenuItem::where('ui_menu_id', '=', $ui_menu->id)
                                   ->whereNull('parent_id')
                                   ->orderBy('position')
                                   ->get();

        $module_menu = $ui_menu->moduleMenu($ui_menu_items);

        $ui_admin_auth = $request->session()->get('ui_admin_auth');
        $ui_admin_auth->admin_menu = $ui_menu->adminMenu($ui_menu_items);

        $request->session()->set('ui_admin_auth', $ui_admin_auth);

        $targets = array(
            '0' => 'Mesma aba',
            '1' => 'Nova aba'
        );

        $this->_dataView['targets'] = $targets;
        $this->_dataView['module_menu'] = $module_menu;
        $this->_dataView['ui_modules'] = $ar_ui_modules;
        $this->_dataView['module_action'] = 'Itens - '. $ui_menu->name;

        return view('uimenu::items', $this->_dataView);
    }
	
}