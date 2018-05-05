<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Order;
use App\OrderItem;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Order page
     */
    public function index()
    {
        $data['foods'] = Menu::where('menu_type', 0)->get();
        $data['beverages'] = Menu::where('menu_type', 1)->get();

        return view('order.index', $data);
    }

    /**
     * Order submission
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->user_id = Auth::id();
        $order->status = 'new';
        $order->save();

        foreach($request->get('items') as $menu_id=>$qty) {
            $item = new OrderItem;
            $item->menu_id = $menu_id;
            $item->qty = $qty;
            $item->status = 'new';
            $order->orderItems()->save($item);
        }

        return redirect('status');
        // return $request->all();
    }

    /**
     * Order status
     */
    public function status()
    {
        $orders = Order::where('user_id', Auth::id())->orderBy('id', 'DESC')->get();

        return view('status.index', [
            'orders' => $orders
        ]);
    }
}
