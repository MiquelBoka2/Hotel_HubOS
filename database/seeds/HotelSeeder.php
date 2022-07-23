<?php

use Illuminate\Database\Seeder;

class HotelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();
        for($i=0;$i<10;$i++){
            DB::table('hotels')->insert([
                'name' => $faker->company,
                'street' => $faker->streetAddress,
                'postal_code' => $faker->postcode,
                'city' => $faker->city,
                'country' => $faker->country,
                'email' => $faker->email,
                'phone' => $faker->phoneNumber
            ]);
        }
    }
}
