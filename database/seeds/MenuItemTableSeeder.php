<?php

use Illuminate\Database\Seeder;

class MenuItemTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ui_menu_item')->delete();        

        DB::table('ui_menu_item')->insert([
            'ui_menu_id' => '1',
            'name' => 'Menu',
            'menu_type' => '1',
            'link' => '',
            'target' => '0',
        ]);

        DB::table('ui_menu_item')->insert([
            'ui_menu_id' => '1',
            'name' => 'Usuário',
            'menu_type' => '0',
            'link' => 'uiadmin/uiuser/index',
            'target' => '0',
        ]);

        DB::table('ui_menu_item')->insert([
            'ui_menu_id' => '1',
            'name' => 'Perfil de acesso',
            'menu_type' => '0',
            'link' => 'uiadmin/uiprofile/index',
            'target' => '0',
        ]);

        DB::table('ui_menu_item')->insert([
            'ui_menu_id' => '1',
            'name' => 'Módulo',
            'menu_type' => '0',
            'link' => 'uiadmin/uimodule/index',
            'target' => '0',
        ]);

        DB::table('ui_menu_item')->insert([
            'ui_menu_id' => '1',
            'name' => 'Menu',
            'menu_type' => '0',
            'link' => 'uiadmin/uimenu/index',
            'target' => '0',
        ]);
    }
}
