<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $Cart =Cart::where("user_id", $user_id)->get();
            $Product = Product::get();
            $Category = Category::get();
            return view('eccom.cart', compact('Category', 'Cart', 'Product'));

        }
        else{

            $Cart = collect([]);
            $Product = Product::get();
            $Category = Category::get();
            return view('eccom.cart', compact('Category', 'Cart', 'Product'));

        }

        return view("eccom.cart");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if(Auth::check()){
         $user_id = Auth::user()->id;
         $product_id = $id ;
         if (!Cart::where('product_id', $product_id)->where('user_id', $user_id)->exists()) {
            Cart::create([
                'product_id' => $product_id,
                'user_id' => $user_id,
                'count' => 1,
            ]);


            return to_route("eccom.index");


        } else {

            $card = Cart::where('product_id', $product_id)->where('user_id', $user_id)->first();
            $card->increment('count');

            return to_route("eccom.index");
        }
        }
        else{

            return to_route("login.index");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        Cart::where("product_id",$id)->delete();
        return to_route("cart.index");
    }
}
