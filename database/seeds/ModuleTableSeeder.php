<?php

use Illuminate\Database\Seeder;

class ModuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ui_module')->delete();

        DB::table('ui_module')->insert([
            'name' => 'Módulo',
            'module' => 'UiModule',
            'route' => 'uiadmin/uimodule',
        ]);

        DB::table('ui_module')->insert([
            'name' => 'Perfil de Acesso',
            'module' => 'UiProfile',
            'route' => 'uiadmin/uiprofile',
        ]);

        DB::table('ui_module')->insert([
            'name' => 'Usuário',
            'module' => 'UiUser',
            'route' => 'uiadmin/uiuser',
        ]);

        DB::table('ui_module')->insert([
            'name' => 'Menu',
            'module' => 'UiMenu',
            'route' => 'uiadmin/uimenu',
        ]);
    }
}
