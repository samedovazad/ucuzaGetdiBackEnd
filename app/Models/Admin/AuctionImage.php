<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;

class AuctionImage extends Model
{
    use SoftDeletes;

    public function auction(){
        return $this->belongsTo(Auction::class);
    }

    public function getRealImagePath(){
        return Storage::url($this->image_path);
    }
}
