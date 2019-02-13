<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    public $timestamps = false;

    public function category(){
        return $this->belongsTo(Category::class);
    }
}
