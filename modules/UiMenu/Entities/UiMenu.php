<?php namespace Modules\Uimenu\Entities;

use Illuminate\Database\Eloquent\Model;

class UiMenu extends Model
{
    protected $table = 'ui_menu';
    protected $fillable = ['name'];

    public function moduleMenu($ui_menu_itens) {

        $html = '<ol class="dd-list">';

        foreach ($ui_menu_itens as $ui_menu_item)
        {
            $html .= '<li class="dd-item" data-id="'. $ui_menu_item->id .'">
                        <div class="dd-handle dd3-handle">Drag</div>
                        <div class="dd3-content">';
            

            if(strtoupper($ui_menu_item->menu_type) == 'SEP')
            {
                $html .= '(<i>separador</i>)';
            } elseif (strtoupper($ui_menu_item->menu_type) == 'TIT') {
                $html .= $ui_menu_item->name .' (<i>título</i>)';
            } else {
                $html .= $ui_menu_item->name;
            }

            $html .= '<span class="pull-right">';

            if(strtoupper($ui_menu_item->menu_type) != 'SEP')
            {
                $html .= '<a href="#" class="btn btn-xs btn-warning btEditMenu" ui_menu_item="'. $ui_menu_item->id .'" title="Editar">
                            <i class="fa fa-pencil-square">&nbsp;&nbsp;Editar</i>
                          </a>';
            }

            $html .= '&nbsp;';
            $html .= '<a href="#" class="btn btn-xs btn-danger btRemoveMenu" ui_menu_item="'. $ui_menu_item->id .'" title="Remover">
                        <i class="fa fa-minus-square">&nbsp;&nbsp;Remover</i>
                      </a>';

            $html .= '</span>';
            $html .= '</div>';

            $children = $ui_menu_item->children($ui_menu_item->id);

            if(count($children) > 0)
            {
                $html .= $this->moduleMenuChildren($children);
            }

            $html .= '</li>';
        }

        $html .= '</ol>';

        return $html;
    }

    public function moduleMenuChildren($ui_menu_itens) {

        $html = '<ol class="dd-list">';

        foreach ($ui_menu_itens as $ui_menu_item)
        {
            $html .= '<li class="dd-item" data-id="'. $ui_menu_item->id .'">
                        <div class="dd-handle dd3-handle">Drag</div>
                        <div class="dd3-content">';

            if(strtoupper($ui_menu_item->menu_type) == 'SEP')
            {
                $html .= '(<i>separador</i>)';
            } elseif (strtoupper($ui_menu_item->menu_type) == 'TIT') {
                $html .= $ui_menu_item->name .' (<i>título</i>)';
            } else {
                $html .= $ui_menu_item->name;
            }

            $html .= '<div class="pull-right">';


            if(strtoupper($ui_menu_item->menu_type) != 'SEP')
            {
                $html .= '<a href="#" class="btn btn-xs btn-warning btEditMenu" ui_menu_item="'. $ui_menu_item->id .'" title="Editar">
                            <i class="fa fa-pencil-square">&nbsp;&nbsp;Editar</i>
                          </a>';
            }

            $html .= '&nbsp;';
            $html .= '<a href="#" class="btn btn-xs btn-danger btRemoveMenu" ui_menu_item="'. $ui_menu_item->id .'" title="Remover">
                        <i class="fa fa-minus-square">&nbsp;&nbsp;Remover</i>
                      </a>';

            $html .= '</div>';
            $html .= '</div>';

            $children = $ui_menu_item->children($ui_menu_item->id);

            if(count($children) > 0)
            {
                $html .= $this->moduleMenuChildren($children);
            }

            $html .= '</li>';
        }

        $html .= '</ol>';

        return $html;
    }

    public function adminMenu($ui_menu_itens) {

        $html = '<ul class="nav sidebar-menu">';

        foreach ($ui_menu_itens as $ui_menu_item)
        {
            $target = '_self';

            if($ui_menu_item->target == 1)
                $target = '_blank';

            if($ui_menu_item->menu_type == 1)
            {
                $html .= '<li class="sidebar-label pt20">'. $ui_menu_item->name .'</li>';
            } else {

                $children = $ui_menu_item->children($ui_menu_item->id);

                if(count($children) > 0)
                {
                    $html .= '<li>
                                <a class="accordion-toggle" href="#">
                                    <span class="sidebar-title">Relatórios</span>
                                    <span class="caret"></span>
                                </a>';
                        
                    $html .= $this->adminMenuChildren($children);

                    $html .= '</li>';

                } else {
                    $html .= '<li>
                                <a target="'. $target .'" href="'. url($ui_menu_item->link) .'">
                                    <span class="sidebar-title">'. $ui_menu_item->name .'</span>
                                </a>
                              </li>';
                }
            }
        }

        $html .= '</ul>';

        return $html;
    }

    public function adminMenuChildren($ui_menu_itens) {

        $html = '<ul class="nav sub-nav">';

        foreach ($ui_menu_itens as $ui_menu_item)
        {
            $target = '_self';

            if($ui_menu_item->target == 1)
                $target = '_blank';
            
        	$html .= '<li>
                        <a target="'. $target .'" href="'. url($ui_menu_item->link) .'">'. $ui_menu_item->name .'</a>
                      </li>';
        }

        $html .= '</ul>';

        return $html;
    }
}
