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
        User::create([
            'user_name' => 'Administrator',
            'email' => 'administrator@canteen.its.ac.id',
            'password' => bcrypt('qweqwe'),
            'user_role' => '4',
            'is_user_verified' => true,
        ]);

        User::create([
            'user_name' => 'Brian Rainer',
            'email' => 'brian@gmail.com',
            'password' => bcrypt('qweqwe'),
            'user_role' => '0',
            'is_user_verified' => true,
        ]);

        User::create([
            'user_name' => 'Dian',
            'email' => 'dian@gmail.com',
            'password' => bcrypt('qweqwe'),
            'user_role' => '1',
            'toko_id' => '1',
            'is_user_verified' => true,
        ]);

        User::create([
            'user_name' => 'Kana',
            'email' => 'kana@gmail.com',
            'password' => bcrypt('qweqwe'),
            'user_role' => '1',
            'toko_id' => '2',
            'is_user_verified' => true,
        ]);

        User::create([
            'user_name' => 'Wahyu',
            'email' => 'wahyu@gmail.com',
            'password' => bcrypt('qweqwe'),
            'user_role' => '1',
            'toko_id' => '3',
            'is_user_verified' => true,
        ]);

        User::create([
            'user_name' => 'Sri',
            'email' => 'sri@gmail.com',
            'password' => bcrypt('qweqwe'),
            'user_role' => '1',
            'toko_id' => '4',
            'is_user_verified' => true,
        ]);

        User::create([
            'user_name' => 'Adelia',
            'email' => 'adelia@gmail.com',
            'password' => bcrypt('qweqwe'),
            'user_role' => '2',
            'is_user_verified' => true,
        ]);

    }
}
