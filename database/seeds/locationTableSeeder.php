<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class locationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create('App\House');
        for($i=0;$i<50;$i++){
	        DB::table('houses')->insert([
                'house_no' => 'House-c25',
	        	'house_name' => $faker->name,
	        	'adress' => $faker->address,
	        	'type' => 'house',
	        	'lat' => $faker->unique()->latitude(23.990957, 24.018872),
	        	'lng' => $faker->unique()->longitude(89.228932, 89.26561),
	        	'created_at' => \Carbon\Carbon::now(),
	        	'Updated_at' => \Carbon\Carbon::now(),
	        ]);
    	}
    }
}
