<?php

namespace App\Models;

use App\Models\User;
use App\Models\category;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    protected $fillable =[
        "name",
        "price",
        "sale",
        "count",
        "category_id",
        "img"
    ];
    public function category()
    {
        return $this->belongsTo(category::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class,"carts") ;
    }


    public static function saveImage($image)
    {
        $uploadimage =[];
       foreach ($image["img"]  as $key=> $img) {
        $newimage= md5(uniqid()).".".$img->extension();
        if(move_uploaded_file($_FILES["img"]["tmp_name"][$key],storage_path("app/public/images/$newimage"))){
            $uploadimage[]=$newimage;
        }
        }
       $imageDB =implode("+",$uploadimage);
       return $imageDB;

    }
    public static function DeleteImage($id)
    {

            $file= product::where("id",$id)->pluck("img")->first();
            $imageDB =explode("+",$file);
            foreach($imageDB as $img){
                unlink(storage_path("app/public/images/$img"));
            }
    }
}
