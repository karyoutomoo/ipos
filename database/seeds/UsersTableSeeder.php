<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\User::class, 5)->create();
        
        App\User::create([
            'user_name' => 'Administrator',
            'email' => 'admin@test.com',
            'password' => Hash::make('iposxxx'),
            'user_role' => '3',
        ]);
    }
}
