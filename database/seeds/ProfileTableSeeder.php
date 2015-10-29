<?php

use Illuminate\Database\Seeder;

class ProfileTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	DB::table('ui_profile')->delete();

        DB::table('ui_profile')->insert([
            'name' => 'Administrador',
            'root' => '1',
        ]);

        DB::table('ui_profile')->insert([
            'name' => 'Administrador do site',
            'root' => '0',
        ]);
    }
}
