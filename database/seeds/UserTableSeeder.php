<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ui_user')->delete();

        DB::table('ui_user')->insert([
            'ui_profile_id' => '1',
            'name' => 'Administrador',
            'email' => 'admin@uicms.com.br',
            'password' => md5('123456'),
            'active' => '1',
        ]);
    }
}
