<?php namespace Modules\Uimenu\Entities;

use Illuminate\Database\Eloquent\Model;

class UiMenuItem extends Model
{
    protected $table = 'ui_menu_item';
    protected $fillable = ['ui_menu_id', 'parent_id', 'name', 'link', 'target', 'position'];


    public function children($parent_id, $ui_profile_id = null) {

        $menu = UiMenuItem::where('ui_menu_item.parent_id', '=', $parent_id);

        //Verifica se é para fazer a consulta com relacionamento do perfil
        if(!empty($ui_profile_id))
        {
            $menu->join('ui_acl')->on('ui_acl.ui_menu_item_id', '=', 'ui_menu_item.id')
                 ->where('ui_acl.ui_profile_id', '=', $ui_profile_id)
                 ->groupBy('ui_menu_item.id');
        }

        $menu = $menu->get();

        return $menu;
    }

    public function order($menuserialize, $id = null)
    {
        foreach ($menuserialize as $position => $item)
        {
            $ui_menu_item = UiMenuItem::find($item->id);
            $ui_menu_item->position = ($position + 1);

            if(!empty($id))
                $ui_menu_item->parent_id = $id;

            $ui_menu_item->save();

            if(!empty($item->children))
                $this->order($item->children, $item->id);
        }
    }
}
