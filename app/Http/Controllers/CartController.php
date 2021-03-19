<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $cartProduct = DB::table('carts')
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('carts.*', 'products.name', 'products.price')
            ->get();
        return view("cart.show", [
            "cartProducts" => $cartProduct
        ]);
    }

    public function add(Product $product)
    {
        $cartItem = new Cart();

        if(count(Cart::where("product_id", $product->id)->get())) {
            $cartUpdate = Cart::where("product_id", $product->id)->where("user_id", auth()->id())->get();
            for($i = 0; $i < count($cartUpdate); $i++) {
                if($i == 0) {
                    $cartUpdate[$i]->update(["quantity" => $cartUpdate[$i]->quantity+1]);
                }
            }
        } else {
            $cartItem->user_id = auth()->id();
            $cartItem->product_id = $product->id;
            $cartItem->product_name = $product->name;
            $cartItem->quantity = 1;
            $cartItem->save();
        }

        return redirect()->back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request)
    {
        Cart::where("product_id", $request->product_id)->update(["quantity" => $request->quantity]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Cart::where("product_id", $request->product_id)->delete();
        return response()->json(["msg" => "deleted"], 200);
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }


}
