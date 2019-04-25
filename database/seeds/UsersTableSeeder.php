<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create('en_GB');
        $faker->addProvider(new Faker\Provider\en_GB\Address($faker));

        $users = [
            ["name" => "user1", "userid" => "user1", "email" => "user1@gmail.com", "password" => bcrypt("password")],
            ["name" => "user2", "userid" => "user2", "email" => "user2@gmail.com", "password" => bcrypt("password")],
            ["name" => "user3", "userid" => "user3", "email" => "user3@gmail.com", "password" => bcrypt("password")],
            ["name" => "user4", "userid" => "user4", "email" => "user4@gmail.com", "password" => bcrypt("password")],
            ["name" => "user5", "userid" => "user5", "email" => "user5@gmail.com", "password" => bcrypt("password")]
        ];

        for ($i = 0; $i < sizeof($users); $i++) {
            DB::table('users')->insert([
                'name'       => $users[$i]['name'],
                'userid'     => $users[$i]['userid'],
                'email'      => $users[$i]['email'],
                'password'   => $users[$i]['password'],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }
    }
}
