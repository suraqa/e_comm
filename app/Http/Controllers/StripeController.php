<?php
namespace App\Http\Controllers;

use App\Models\User;
use Stripe;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class StripeController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function stripe()
    {
        $cartProduct = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.name', 'products.price')
            ->get();
        return view("stripe", [
            "cartProducts" => $cartProduct
        ]);
    }

    public function stripePost(Request $request, Response $response)
    {

        Stripe\Stripe::setApiKey("sk_test_51IRhvAKkz2PvTdyxiy8MgzsK06jaj33uNYgu6WuwJdWniZENPi5MyimrYhzysrjfmfgpm5GkMQbqlRLZzWSzNA0s005UAKwTLA");
        Stripe\Charge::create ([
            "amount" => $request->input("total")*100,
            "currency" => "PKR",
            "source" => $request->stripeToken,
            "description" => "This payment is testing purpose"
        ]);

        Session::flash('success', 'Payment Successful !');

        return back();
        // return response()->json(["msg" => "paid"], 200);
    }
}
