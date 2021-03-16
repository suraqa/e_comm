<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware("auth");
    }

    public function add(Product $product)
    {
        $cartItem = array();
        // array_push($cartItem, [
        //     "name" => $product->name,
        //     "price" => $product->price,
        //     "quantity" => 1
        // ]);
        // Session::push(auth()->id(), [
        //     $product->id => $cartItem
        // ]);

        if(!Session::get(auth()->id())) {
            Session::put(auth()->id(), []);
            $cartItem = [
                $product->id => [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => 1
                ]
            ];
            Session::push(auth()->id(), $cartItem);
        } else {
            $cartItem = [
                $product->id => [
                    "name" => $product->name,
                    "price" => $product->price,
                    "quantity" => 1
                ]
            ];
            Session::push(auth()->id(), $cartItem);
        }


        return view("cart.add");
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
