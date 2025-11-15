<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
   function rel_to_subcategory(){
    return $this->hasMany(Subcategory::class,'category_id');
   }
}
