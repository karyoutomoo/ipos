<?php

use Illuminate\Database\Seeder;
use App\Food;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
      Food::truncate();

      $faker = \Faker\Factory::create();

      for ($i=0; $i < 50 ; $i++) { 
        Food::create([
          'name' => $faker->name,
          'outlet' => $faker->company,
          'description' => $faker->paragraph,
          'price' => $faker->randomNumber(3),
          'availability' => $faker->boolean(50)
        ]);
      }
    }
}
