<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryTableSeeder extends Seeder
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

        $countries = [
            'Singapore',
            'Myanmar',
            'Indonesia',
            'Malaysia',
            'Thailand',
            'Korea'
        ];

        for ($i = 0; $i < sizeof($countries); $i++) {
            DB::table('country')->insert([
                'name'       => $countries[$i],
                'created_at' => $faker->dateTime,
                'updated_at' => $faker->dateTime
            ]);
        }

    }
}
