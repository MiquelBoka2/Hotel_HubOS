<?php

use Illuminate\Database\Seeder;

class RoomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $faker = Faker\Factory::create();
        for($i=0;$i<150;$i++){
            DB::table('rooms')->insert([
                'name' => $faker->secondaryAddress,
                'capacity' => $faker->numberBetween(1,5),
                'floor' => $faker->numberBetween(1,10),
                'status' => false,
                'hotel_id' => $faker->numberBetween(1,10)
            ]);
        }
    }
}
