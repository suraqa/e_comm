<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }

    public function add(Request $request)
    {
        $cartIds = $request["cart_ids"];
        $order = new Order();
        $order->user_id = auth()->id();
        $order->cart_ids = $cartIds;
        $order->save();



        $cartIds_arr = explode(",", $cartIds);

        foreach($cartIds_arr as $cartIds) {
            Cart::find($cartIds)->delete();
        }


    }
}
