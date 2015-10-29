<?php namespace Modules\Uiadmin\Http\Controllers;

use Pingpong\Modules\Routing\Controller;

class UiAjaxController extends Controller {
	
	public function __construct()
    {
        $this->beforeFilter('auth', array('except' => 'login'));
        $this->beforeFilter('csrf', array('on' => 'post'));
    }

	public function uipopulatecombobox()
	{
		//Recebe os dados que vieram via POST
        $params = \Input::all();

        //Verifica se recebeu algum dado
        if ($params)
        {
            $ui_models = \DB::table($params['table']);

            foreach ($params['conditions'] as $condition)
            {
                $ui_models->where($condition['field'], $condition['condition'], $condition['value']);
            }

            $ui_models = $ui_models->get();

            $html = '<option value="">Selecione...</option>';

            if(count($ui_models) > 0)
            {
                foreach ($ui_models as $ui_model)
                {
                    if(!empty($params['selected']) && $params['selected'] == $ui_model->{$params['value']})
                        $html .= '<option selected="selected" value="'. $ui_model->{$params['value']} .'">'. $ui_model->{$params['label']} .'</option>';
                    else
                        $html .= '<option value="'. $ui_model->{$params['value']} .'">'. $ui_model->{$params['label']} .'</option>';
                }
            }

            echo $html;
        }
	}

	public function uimodalsave()
    {
        //Recebe os dados que vieram via POST
        $params = \Input::all();

        //Verifica se recebeu algum dado
        if ($params)
        {
        	//Limpa parametro desnecessario
        	unset($params['_token']);
			
    		$fields = \DB::getSchemaBuilder()->getColumnListing($params['table']);

    		$db_fields = [];

        	foreach ($params as $field => $value) 
        	{
        		if(in_array($field, $fields))
        		{
        			$db_fields[$field] = $value;
        		}
        	}

        	if(!empty($params['ui_menu_item_id']))
        	{
        		$db_fields['updated_at'] = date('Y-m-d H:i:s');

	    		echo \DB::table($params['table'])->where('id', '=', $params['ui_menu_item_id'])->update($db_fields);
        	} else {

	        	$db_fields['created_at'] = date('Y-m-d H:i:s');

	    		echo \DB::table($params['table'])->insert($db_fields);
	    	}
        }
    }

    public function uifind()
    {
        //Recebe os dados que vieram via POST
        $params = \Input::all();

        //Verifica se recebeu algum dado
        if ($params)
        {
        	if(!empty($params['id']))
        	{
        		$ui_model = \DB::table($params['table'])->where('id', '=', $params['id'])->first();

        		if(count($ui_model) > 0)
        		{
        			$ui_result = $ui_model;

        			if(!empty($params['alias']))
        			{
        				foreach ($params['alias'] as $alias)
        				{
        					$ui_result[$alias['field']] = $ui_model->{$alias['value']}();
        				}
        			}
					
	            	echo json_encode($ui_result);
        		}
        	}
        }
    }

    public function uimodalremove()
    {
        //Recebe os dados que vieram via POST
        $params = \Input::all();

        //Verifica se recebeu algum dado
        if ($params)
        {
        	if(!empty($params['id_remove']))
        	{
        		echo \DB::table($params['table'])->where('id', '=', $params['id_remove'])->delete();
        	}
        }
    }
	
}