<?php

namespace App\Http\Controllers\website;

use App\Models\Cart;
use App\Models\product;
use App\Models\category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(Auth::check()){
            $user_id = Auth::user()->id;
            $Cart =Cart::where("user_id", $user_id)->get();
            $Product=product::get();
            $Category=category::with("products")->paginate(5);
            return view("eccom.login",compact("Category","Cart","Product"));

        }
        else{

            $Cart = collect([]);
            $Product=product::get();
            $Category=category::with("products")->paginate(5);
            return view("eccom.login",compact("Category","Cart","Product"));

        }




    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Auth::logout();
        return to_route("eccom.index");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data= $request->except("_token");
        if(Auth::attempt($data)){
            return to_route("eccom.index");
        }
        else{
            return to_route("register.index");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }
}
