<?php

namespace App\Http\Controllers\dash;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\category;
use App\Models\product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $Product=product::get();
        $Category=category::get();
        return view("dashbord.product.view",compact("Product","Category"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $Category= category::get();
        return view("dashbord.product.create",compact("Category"));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductRequest $request)
    {
        $Images=$request->only("img") ;
        $data=$request->except("img");
        $nameimages=  product::saveImage($Images);
        product::create([
            'name' => $data["name"] ,
            'price' => $data["price"] ,
            'sale' =>  $data["sale"],
            'count' => $data["count"],
            'category_id' => $data["category_id"] ,
            'img' =>$nameimages
        ]);
        return to_route("product.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product=  product::findOrfail($id);
        $Category=category::get();
        return view("dashbord.product.update",compact("product","Category"));
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
        if($request->hasFile("img")){
            $data=$request->except("img","_token","_method");
            $images=$request->only("img");
            product::DeleteImage($id);
           $nameimages=  product::saveImage($images);
            $nameimages;
            product::where("id",$id)->update([
                'name' => $data["name"] ,
                'price' => $data["price"] ,
                'sale' =>  $data["sale"],
                'count' => $data["count"],
                'category_id' => $data["category_id"] ,
                'img' =>$nameimages
            ]);
            return to_route("product.index");




        }
        else{
            $data=$request->except("img","_token","_method");
            product::where("id",$id)->update($data);
            return to_route("product.index");

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        product::DeleteImage($id);
        product::where("id",$id)->delete();
        return to_route("product.index");
    }
}
