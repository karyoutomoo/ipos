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
        $user_id = Auth::user()->id;
        $toko_id = Auth::user()->toko_id;
        $role = Auth::user()->user_role;

        if ($role == 0) {
            $data['orders'] = DB::table('orders')
                ->join('users','orders.user_id','=','users.id')
                ->join('order_items', 'orders.id','=','order_items.order_id')
                ->join('menus', 'menus.id','=','order_items.menu_id')
                ->select('users.id','users.user_name', 'order_items.*', 'menus.*')
                ->where('users.id', $user_id)
                ->orderBy('order_items.order_id', 'DESC')
                ->get();
        } else if ($role == 1) {
            $data['orders'] = DB::table('orders')
                ->join('users','orders.user_id','=','users.id')
                ->join('order_items', 'orders.id','=','order_items.order_id')
                ->join('menus', 'menus.id','=','order_items.menu_id')
                ->select('users.user_name', 'order_items.*', 'menus.*')
                ->where('menus.store_id', $toko_id)
                ->orderBy('order_items.order_id', 'DESC')
                ->get();
        } else if ($role == 2){
            $data['orders'] = DB::table('orders')
                ->join('users','orders.user_id','=','users.id')
                ->join('order_items', 'orders.id','=','order_items.order_id')
                ->join('menus', 'menus.id','=','order_items.menu_id')
                ->select('users.user_name', 'order_items.*', 'menus.*')
                ->where('order_items.order_item_status', "DITERIMA")
                ->orWhere('order_items.order_item_status', "LUNAS")
                ->orderBy('order_items.order_id', 'DESC')
                ->get();            
        }

        $data['user_role'] = $role;
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
            $item->order_item_status = 'MENUNGGU';
            $item->order_id = $order->id;
            $item->save();
            // $order->orderItems()->save($item);
        }

        return redirect()->action('OrdersController@status_index');
        // return $request->all();
    }

    public function accept_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'DITERIMA';
        $order_item->save();

        return redirect()->action('OrdersController@status_index');
    }

    public function pay_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'LUNAS';
        $order_item->save();

        return redirect()->action('OrdersController@status_index');
    }

    public function ask_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'MOHON TUKAR';
        $order_item->save();

        return redirect()->action('OrdersController@status_index');
    }

    public function close_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'DITUKARKAN';
        $order_item->save();

        return redirect()->action('OrdersController@status_index');
    }

    public function cancel_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'DIBATALKAN';
        $order_item->save();

        return redirect()->action('OrdersController@status_index');
    }
}
