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
      $faker = \Faker\Factory::create();

      for ($i=0; $i < 50 ; $i++) { 
        Food::create([
          'name' => $faker->title,
          'outlet' => $faker->title,
          'description' => $faker->paragraph,
          'price' => $faker->randomNumber(3),
          'availability' => $faker->boolean(50)
        ]);
      }
    }
}
