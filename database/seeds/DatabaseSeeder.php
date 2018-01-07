<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UsersTableSeeder');
        factory('App\Models\User')->create();
        factory('App\Models\Vehicle', 2)->create();
        factory('App\Models\Sale', 2)->create();
        factory('App\Models\Cost', 2)->create();
        factory('App\Models\Account')->create();
    }
}
