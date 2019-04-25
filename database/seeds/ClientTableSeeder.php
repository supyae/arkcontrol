<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ClientTableSeeder extends Seeder
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

        $country = DB::table('country')->get(['id'])->toArray();
        $business = DB::table('business_type')->get(['id'])->toArray();
        $deployment = DB::table('deployment_site')->get(['id'])->toArray();

        for ($i = 1; $i <= 15; $i++) {
            DB::table('client')->insert([
                'name'                 => $faker->name,
                'address'              => $faker->address,
                'contact_person_name'  => $faker->name,
                'contact_person_phone' => $faker->phoneNumber,
                'contact_person_email' => $faker->email,
                'country_id'           => $country[array_rand($country)]->id,
                'business_id'          => $business[array_rand($business)]->id,
                'deployment_id'        => $deployment[array_rand($deployment)]->id,
                'created_at'           => $faker->dateTime,
                'updated_at'           => $faker->dateTime
            ]);
        }

        //custom command line message
        $this->command->getOutput()->writeln("<info>Seeding:</info> ClientTableSeeder Successfully !");
    }
}
