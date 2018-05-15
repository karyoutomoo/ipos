<?php

use Illuminate\Database\Seeder;
use App\Menu;

class MenusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Menu::create([
        'menu_name' => 'Hayaku Sushi',
        'menu_type' => false,
        'menu_price' => '12000',
        'menu_description' => 'Irrashaimase! Hayaku Sushi wa daisuki! Hayaku Sushi wa oishiiii desuyo! murah meriah enak...',
        'menu_imagepath' => '/storage/makanan/Hayaku Sushi.jpg',
        'menu_status' => true,
        'store_id' => '1',
      ]);

      Menu::create([
        'menu_name' => 'Soto Ayam Lamongan',
        'menu_type' => false,
        'menu_price' => '10000',
        'menu_description' => 'Soto Ayam Lamongan Bu Kana\nTelah berdiri sejak 1983,\nSoto ayam bu Kana telah setia melayani civitas akademika dan terjamin kualitas rasanya\n',
        'menu_imagepath' => '/storage/makanan/Soto Ayam Lamongan.jpg',
        'menu_status' => true,
        'store_id' => '2',
      ]);

      Menu::create([
        'menu_name' => 'Soto Ayam Lamongan Jumbo',
        'menu_type' => false,
        'menu_price' => '13000',
        'menu_description' => 'Soto Ayam Lamongan Bu Kana\nTelah berdiri sejak 1983,\nSoto ayam bu Kana telah setia melayani civitas akademika dan terjamin kualitas rasanya\nSekarang hadir porsi JUMBO!!!',
        'menu_imagepath' => '/storage/makanan/Soto Ayam Lamongan Jumbo.jpg',
        'menu_status' => true,
        'store_id' => '2',
      ]);

      Menu::create([
        'menu_name' => 'Teh Poci',
        'menu_type' => true,
        'menu_price' => '4000',
        'menu_description' => 'Teh Poci, sehat menyegarkan!',
        'menu_imagepath' => '/storage/makanan/Teh Poci.jpg',
        'menu_status' => true,
        'store_id' => '3',
      ]);

      Menu::create([
        'menu_name' => 'Es Jeruk',
        'menu_type' => true,
        'menu_price' => '4500',
        'menu_description' => 'Jus Jeruk dingin menyegarkan di tengah panas',
        'menu_imagepath' => '/storage/makanan/Es Jeruk.jpg',
        'menu_status' => true,
        'store_id' => '3',
      ]);

      Menu::create([
        'menu_name' => 'Dream Waffle',
        'menu_type' => false,
        'menu_price' => '7000',
        'menu_description' => 'Waffle murah enak mengenyangkan! Terdapat banyak rasa: Cokelat, Keju, Susu, Vanilla, dan Blueberry! Cukup 7 ribu rupiah saja!',
        'menu_imagepath' => '/storage/makanan/Dream Waffle.jpg',
        'menu_status' => true,
        'store_id' => '4',
      ]);
    }
}
