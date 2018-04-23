<?php

use Illuminate\Database\Seeder;
use App\Store;

class StoresTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      Store::truncate();

      $faker = \Faker\Factory::create();

      for ($i=0; $i < 50; $i++) { 
        Store::create([
          'store_name' => $faker->company,
          'location' => $faker->address,
          'status' => $faker->boolean,
        ]);
      }
    }
}
