<?php namespace Modules\Uimodule\Entities;

use Illuminate\Database\Eloquent\Model;

class UiModule extends Model
{
    protected $table = 'ui_module';
    protected $fillable = ['name', 'module', 'route'];

    public function getAllSelect($prompt = false)
    {
    	$ui_modules = UiModule::all();

    	if($prompt)
        	$ar_ui_modules = array();
        else
        	$ar_ui_modules = array('' => 'Selecione...');

        foreach ($ui_modules as $ui_profile) 
        {
        	$ar_ui_modules[$ui_profile->id] = $ui_profile->name;
        }

        return $ar_ui_modules;
    }
}
