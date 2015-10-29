<?php namespace Modules\Uiadmin\Entities;

use Illuminate\Database\Eloquent\Model;

class UiAcl extends Model
{
    protected $table = 'ui_acl';
    protected $fillable = ['ui_profile_id', 'ui_module_action_id'];
}
