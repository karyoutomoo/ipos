<?php

use Illuminate\Database\Seeder;
use App\Order;
use App\OrderItem;

class OrdersTableSeeder extends Seeder
{
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
    $order = Order::create([
      'user_id'=>'1',
    ]);
    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '1',
      'qty' => '1',
      'order_item_status' => 'MENUNGGU',
    ]);

    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '2',
      'qty' => '1',
      'order_item_status' => 'SUDAH DITUKARKAN',
    ]);

    $order = Order::create([
      'user_id'=>'2',
    ]);
    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '1',
      'qty' => '1',
      'order_item_status' => 'SUDAH DITUKARKAN',
    ]);

    $order = Order::create([
      'user_id'=>'2',
    ]);
    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '2',
      'qty' => '1',
      'order_item_status' => 'DIBATALKAN',
    ]);

    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '3',
      'qty' => '1',
      'order_item_status' => 'SUDAH DITUKARKAN',
    ]);

    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '4',
      'qty' => '1',
      'order_item_status' => 'LUNAS',
    ]);

    $order = Order::create([
      'user_id'=>'2',
    ]);
    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '5',
      'qty' => '1',
      'order_item_status' => 'DITERIMA',
    ]);

    $item = OrderItem::create([
      'order_id' => $order->id,
      'menu_id' => '6',
      'qty' => '1',
      'order_item_status' => 'MENUNGGU',
    ]);
	}
}
