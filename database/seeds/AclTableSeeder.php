<?php

use Illuminate\Database\Seeder;

class AclTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ui_acl')->delete();

        DB::table('ui_acl')->insert([
            'ui_profile_id' => '1',
            'ui_module_action_id' => '1',
        ]);

        DB::table('ui_acl')->insert([
            'ui_profile_id' => '1',
            'ui_module_action_id' => '2',
        ]);

        DB::table('ui_acl')->insert([
            'ui_profile_id' => '1',
            'ui_module_action_id' => '3',
        ]);

        DB::table('ui_acl')->insert([
            'ui_profile_id' => '1',
            'ui_module_action_id' => '4',
        ]);

        DB::table('ui_acl')->insert([
            'ui_profile_id' => '1',
            'ui_module_action_id' => '5',
        ]);

        DB::table('ui_acl')->insert([
            'ui_profile_id' => '1',
            'ui_module_action_id' => '6',
        ]);
    }
}
