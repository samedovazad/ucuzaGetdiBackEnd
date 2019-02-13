<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    public function sub_categories(){
        return $this->hasMany(SubCategory::class);
    }

    public function auctions()
    {
        return $this->hasMany(Auction::class);
    }
}
