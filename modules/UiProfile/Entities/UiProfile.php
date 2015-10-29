<?php namespace Modules\Uiprofile\Entities;

use Illuminate\Database\Eloquent\Model;

class UiProfile extends Model
{
    protected $table = 'ui_profile';
    protected $fillable = ['name'];

    public function getAllSelect($prompt = false)
    {
    	$ui_profiles = UiProfile::all();

        if($prompt)
            $ar_ui_profiles = array();
        else
            $ar_ui_profiles = array('' => 'Selecione...');

        foreach ($ui_profiles as $ui_profile) 
        {
            $ar_ui_profiles[$ui_profile->id] = $ui_profile->name;
        }

        return $ar_ui_profiles;
    }
}
