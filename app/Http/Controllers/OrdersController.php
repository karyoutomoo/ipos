<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Menu;
use App\Order;
use App\OrderItem;
use App\Store;
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
    public function status_index(Request $request){
        $user_id = Auth::user()->id;
        $toko_id = Auth::user()->toko_id;
        $role = Auth::user()->user_role;

        $data['orders'] = DB::table('orders')
            ->join('users','orders.user_id','=','users.id')
            ->join('order_items', 'orders.id','=','order_items.order_id')
            ->join('menus', 'menus.id','=','order_items.menu_id')
            ->select('users.id','users.user_name', 'order_items.*', 'menus.menu_name')
            ->where('users.id', '=', $user_id)
            ->orderBy('order_items.order_id', 'DESC')
            ->get();

        $data['user_name'] = Auth::user()->user_name;
        $data['user_role'] = $role;
        if ($request->query('is_redirect')) {
            $data['last_order_id'] = $data['orders']->first()->order_id;
        } else {
            $data['last_order_id'] = '0';
        }
        return view('status.index', $data);
    }

    public function seller_index(){
        $toko_id = Auth::user()->toko_id;
        $data['store_name'] = Store::find($toko_id)->store_name;
        $data['items'] = DB::table('orders')
            ->join('users', 'users.id','=','orders.user_id')
            ->join('order_items', 'orders.id','=','order_items.order_id')
            ->join('menus', 'menus.id','=','order_items.menu_id')
            ->select('users.user_name', 'order_items.*', 'menus.menu_name')
            ->where('menus.store_id', '=', $toko_id)
            ->orderBy('order_items.order_id', 'DESC')
            ->orderBy('order_items.order_item_status')
            ->get();

        return view('status.seller', $data);
    }

    public function cashier_index(){
        $data['items'] = DB::table('orders')
            ->join('users', 'users.id', '=', 'orders.user_id')
            ->join('order_items', 'orders.id','=','order_items.order_id')
            ->join('menus', 'menus.id','=','order_items.menu_id')
            ->select('users.user_name', 'order_items.*', 'menus.menu_name')
            ->orderBy('order_items.order_id', 'DESC')
            ->orderBy('order_items.order_item_status')
            ->get();
        return view('status.cashier', $data);
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

        return redirect()->action('OrdersController@status_index', ['is_redirect' => true]);
        // return $request->all();
    }

    public function accept_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'DITERIMA';
        $order_item->save();

        return redirect('pemesanan/toko');
    }

    public function pay_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'LUNAS';
        $order_item->save();

        return redirect('pemesanan/kasir');
    }

    public function ask_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'MOHON TUKAR';
        $order_item->save();

        return redirect('pemesanan/status');
    }

    public function close_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'SUDAH DITUKARKAN';
        $order_item->save();

        return redirect('pemesanan/toko');
    }

    public function cancel_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'DIBATALKAN';
        $order_item->save();

        return redirect('pemesanan/status');
    }

    public function reject_order(Request $request)
    {
        $order_item_id = $request['order_item_id'];
        $order_item = OrderItem::find($order_item_id);
        $order_item->order_item_status = 'DITOLAK';
        $order_item->save();

        return redirect('pemesanan/toko');
    }

}
