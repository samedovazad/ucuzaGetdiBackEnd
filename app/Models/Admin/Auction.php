<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User;

class Auction extends Model
{
    use SoftDeletes;

    public function images(){
        return $this->hasMany(AuctionImage::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sub_category()
    {
        return $this->belongsTo(SubCategory::class);
    }

    public function sub_sub_category()
    {
        return $this->belongsTo(SubSubCategory::class);
    }

    public function countries()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }

    public function user_name()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function auction_status()
    {
        return $this->belongsTo(AuctionStatus::class, 'status', 'id');
    }

    public function auction_reject()
    {
        return $this->hasOne(RejectAuction::class);
    }

    public function reserve_price_currency()
    {
        return $this->reserve_price . ' ' . $this->currency;
    }
}
