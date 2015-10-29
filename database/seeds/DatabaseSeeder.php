<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->call(ProfileTableSeeder::class);
        $this->call(MenuTableSeeder::class);
        $this->call(MenuItemTableSeeder::class);
        $this->call(ModuleTableSeeder::class);
        $this->call(ModuleActionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(AclTableSeeder::class);

        Model::reguard();
    }
}
