<?php

use Illuminate\Database\Seeder;

class ModuleActionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ui_module_action')->delete();

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '1',
            'name' => 'Visualizar',
            'action' => 'index',
            'link' => 'uiadmin/uimodule/index',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '1',
            'name' => 'Adicionar',
            'action' => 'create',
            'link' => 'uiadmin/uimodule/create',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '1',
            'name' => 'Editar',
            'action' => 'edit',
            'link' => 'uiadmin/uimodule/edit',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '1',
            'name' => 'Remover',
            'action' => 'delete',
            'link' => 'uiadmin/uimodule/delete',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '1',
            'name' => 'Ações',
            'action' => 'actions',
            'link' => 'uiadmin/uimodule/actions',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '1',
            'name' => 'Remover ações',
            'action' => 'actionsdelete',
            'link' => 'uiadmin/uimodule/actionsdelete',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '2',
            'name' => 'Visualizar',
            'action' => 'index',
            'link' => 'uiadmin/uiprofile/index',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '2',
            'name' => 'Adicionar',
            'action' => 'create',
            'link' => 'uiadmin/uiprofile/create',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '2',
            'name' => 'Editar',
            'action' => 'edit',
            'link' => 'uiadmin/uiprofile/edit',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '2',
            'name' => 'Remover',
            'action' => 'delete',
            'link' => 'uiadmin/uiprofile/delete',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '2',
            'name' => 'Permissões',
            'action' => 'permission',
            'link' => 'uiadmin/uiprofile/premission',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '3',
            'name' => 'Visualizar',
            'action' => 'index',
            'link' => 'uiadmin/uiuser/index',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '3',
            'name' => 'Adicionar',
            'action' => 'create',
            'link' => 'uiadmin/uiuser/create',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '3',
            'name' => 'Editar',
            'action' => 'edit',
            'link' => 'uiadmin/uiuser/edit',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '3',
            'name' => 'Remover',
            'action' => 'delete',
            'link' => 'uiadmin/uiuser/delete',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '4',
            'name' => 'Visualizar',
            'action' => 'index',
            'link' => 'uiadmin/uimenu/index',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '4',
            'name' => 'Adicionar',
            'action' => 'create',
            'link' => 'uiadmin/uimenu/create',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '4',
            'name' => 'Editar',
            'action' => 'edit',
            'link' => 'uiadmin/uimenu/edit',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '4',
            'name' => 'Remover',
            'action' => 'delete',
            'link' => 'uiadmin/uimenu/delete',
        ]);

        DB::table('ui_module_action')->insert([
            'ui_module_id' => '4',
            'name' => 'Itens',
            'action' => 'items',
            'link' => 'uiadmin/uimenu/items',
        ]);
    }
}
