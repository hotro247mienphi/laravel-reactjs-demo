<?php

use App\User;
use Faker\Factory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        $data = [];
        $limit = 200;

        for ($i = 0; $i < $limit; $i++):
            $time = now();
            $data[] = [
                'name' => $faker->name,
                'email' => $faker->email,
                'password' => bcrypt($faker->password),
                'status' => 1,
                'created_at' => $time,
                'updated_at' => $time,
            ];
        endfor;

        try {
            DB::transaction(function () use ($data) {
                User::insert($data);
            });
        } catch (Exception $exception) {
            echo $exception->getMessage();
        }
    }
}
