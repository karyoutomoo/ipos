<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Order;
use App\OrderItem;
use DB;

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
     *  Status page
     */
    public function status_index(){
        $data['orders'] = DB::table('orders')
            ->join('users','orders.user_id','=','users.id')
            ->join('order_items', 'orders.id','=','order_items.order_id')
            ->join('menus', 'menus.id','=','order_items.menu_id')
            ->select('users.user_name', 'order_items.*', 'menus.*')
            ->orderBy('order_items.order_id', 'DESC')
            ->get();

        return view('status.index', $data);
    }

    /**
     * Order submission
     */
    public function store(Request $request)
    {
        $order = new Order;
        $order->user_id = Auth::id();
        $order->save();

        foreach($request->get('items') as $menu_id=>$qty) {
            $item = new OrderItem;
            $item->menu_id = $menu_id;
            $item->qty = $qty;
            $item->order_item_status = 'PENDING';
            $item->order_id = $order->id;
            $item->save();
            // $order->orderItems()->save($item);
        }

        return redirect()->action('OrdersController@status_index');
        // return $request->all();
    }
}
