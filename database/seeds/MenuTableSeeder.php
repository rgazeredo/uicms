<?php

use Illuminate\Database\Seeder;

class MenuTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('ui_menu')->delete();

        DB::table('ui_menu')->insert([
            'name' => 'menu-admin',
            'admin' => '1',
        ]);
    }
}
