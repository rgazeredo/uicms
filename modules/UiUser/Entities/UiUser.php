<?php namespace Modules\Uiuser\Entities;

use Illuminate\Database\Eloquent\Model;

class UiUser extends Model
{
    protected $table = 'ui_user';
    protected $hidden = ['password'];
	protected $fillable = ['ui_profile_id', 'name', 'email', 'password', 'active'];
}
