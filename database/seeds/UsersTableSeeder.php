<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // clear table
      User::truncate();

      $faker = \Faker\Factory::create();

      // make same password for everyone
      $password =  Hash::make('iposxxx');

      User::create([
        'name' => 'Administrator',
        'email' => 'admin@test.com',
        'password' => $password,
        'role' => 'Administrator',
        'phoneNumber' => $faker->e164PhoneNumber,
      ]);

      for ($i=0; $i < 10; $i++) { 
        User::create([
          'name' => $faker->name,
          'email' => $faker->email,
          'password' => $password,
          'role' => $faker->jobTitle,
          'phoneNumber' => $faker->e164PhoneNumber,
        ]);
      }
    }
}
