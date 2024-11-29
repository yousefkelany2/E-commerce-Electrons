<?php

namespace App\Models;

use App\Models\product;
use Illuminate\Database\Eloquent\Model;

class category extends Model
{
    protected $fillable =[
        "name"
        ];
        public function products()
        {
            return $this->hasMany(product::class); 
        }

}
