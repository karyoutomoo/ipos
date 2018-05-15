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
      Store::create([
        'store_name' => 'Hayaku Sushi', 
        'store_location' => 'Outlet No. 8 Sebelah Utara Kantin Pusat ITS',
        'store_status' => true,
        'is_store_verified' => true,
      ]);

      Store::create([
        'store_name' => 'Soto Ibu Kana', 
        'store_location' => 'Outlet No. 1 Pintu Masuk Barat Kantin Pusat ITS',
        'store_status' => true,
        'is_store_verified' => true,
      ]);

      Store::create([
        'store_name' => 'Teh Poci', 
        'store_location' => 'Pintu Masuk Utara Kantin Pusat ITS',
        'store_status' => true,
        'is_store_verified' => true,
      ]);

      Store::create([
        'store_name' => 'Dream Waffle', 
        'store_location' => 'Tengah Kantin Pusat ITS',
        'store_status' => true,
        'is_store_verified' => true,
      ]);
    }
}
