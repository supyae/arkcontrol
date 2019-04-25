<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeploymentSiteTableSeeder extends Seeder
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

        $sites = [
            'Residential',
            'Commercial',
            'Industrial'
        ];

        for ($i = 0; $i < sizeof($sites); $i++) {
            DB::table('deployment_site')->insert([
                'name'        => $sites[$i],
                'description' => $faker->text(20),
                'created_at'  => $faker->dateTime,
                'updated_at'  => $faker->dateTime
            ]);
        }
    }
}
