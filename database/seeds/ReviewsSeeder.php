<?php

use Illuminate\Database\Seeder;
use App\Review;

class ReviewsSeeder extends Seeder
{
  public function run()
  {
    Review::create([
      'user_id' => '2',
      'menu_id' => '1',
      'rating' => '5',
      'content' => 'Sushinya enak walau agak kering',
    ]);

    Review::create([
      'user_id' => '2',
      'menu_id' => '4',
      'rating' => '4',
      'content' => 'Teh Poci selalu saya beli kalo saya mampir ke kantin ITS',
    ]);

    Review::create([
      'user_id' => '2',
      'menu_id' => '2',
      'rating' => '5',
      'content' => 'Salah satu soto terenak yang pernah saya makan',
    ]);

    Review::create([
      'user_id' => '2',
      'menu_id' => '3',
      'rating' => '5',
      'content' => 'Awalnya saya pikir ukuran jumbo bikin eneg tapi ternyata saya salah. Jumbo is better than normal.',
    ]);

    Review::create([
      'user_id' => '2',
      'menu_id' => '6',
      'rating' => '3',
      'content' => 'Lumayan untuk mengisi perut.. Tapi harganya kemahalan, mending saya beli soto',
    ]);
  }
}