<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Review;
use DB;

class ReviewsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Review page
     */
    public function index()
    {
        $reviews = Review::where('user_id', Auth::id())->get();

        $new_menus = DB::table('menus')
            ->join('order_items', 'order_items.menu_id','=','menus.id')
            ->join('orders','orders.id','=','order_items.order_id')
            ->join('stores','stores.id','=','menus.store_id')
            ->select('menus.*', 'stores.store_name')
            ->where('orders.user_id', '=', Auth::id())
            ->whereNotExists(function($query) {
                $query->select(DB::raw(1))
                ->from('reviews')
                ->whereRaw('reviews.menu_id = menus.id')
                ->whereRaw('reviews.user_id = orders.user_id');
            })
            ->distinct()
            ->get();

        return view('review.index', [
            'reviews' => $reviews,
            'new_menus' => $new_menus
        ]);
    }

    /**
     * Review submission
     */
    public function store(Request $request)
    {
        $review = new Review;
        $review->user_id = Auth::id();
        $review->menu_id = $request->get('menu');
        $review->rating = $request->get('rating');
        $review->content = $request->get('content');
        $review->save();

        return redirect()->action('ReviewsController@index');
    }
}