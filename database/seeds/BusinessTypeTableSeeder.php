<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessTypeTableSeeder extends Seeder
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

        $businesses = [
            'Sales & Marketing',
            'Software House',
            'Digital Agency'
        ];

        for ($i = 0; $i < sizeof($businesses); $i++) {
            DB::table('business_type')->insert([
                'name'        => $businesses[$i],
                'description' => $faker->text(20),
                'created_at'  => $faker->dateTime,
                'updated_at'  => $faker->dateTime
            ]);
        }
    }
}
