<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     *
     * php artisan migrate:fresh --seed
     */
    public function run()
    {
         $this->call(UsersTableSeeder::class);
    }
}
