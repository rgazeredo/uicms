<?php namespace Modules\Uimodule\Entities;

use Illuminate\Database\Eloquent\Model;

class UiModuleAction extends Model
{
    protected $table = 'ui_module_action';
    protected $fillable = ['ui_module_id', 'name', 'action', 'link'];
}
