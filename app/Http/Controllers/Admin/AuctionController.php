<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\AuctionValidator;
use App\Models\Admin\Auction;
use App\Models\Admin\AuctionImage;
use App\Models\Admin\Category;
use App\Models\Admin\City;
use App\Models\Admin\Country;
use App\Models\Admin\RejectAuction;
use App\Models\Admin\SubCategory;
use App\Models\Admin\SubSubCategory;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;

class AuctionController extends Controller
{
    public function index()
    {
        $auctionObj = Auction::orderByDesc('id');

        $filteredData = request()->all();
        $filteredUsers = urldecode(request('users'));
        $filteredAuctionStatuses = urldecode(request('auction_status'));
        $filteredData['users'] = explode(",", $filteredUsers);
        $filteredData['auction_status'] = explode(",", $filteredAuctionStatuses);
        if ( request()->filled('category')) $filteredData['category'] = ['id' => request('category') , 'text' => Category::find(request('category'))->name];
        if ( request()->filled('sub_category')) $filteredData['sub_category'] = ['id' => request('sub_category') , 'text' => SubCategory::find(request('sub_category'))->name];
        if ( request()->filled('sub_sub_category')) $filteredData['sub_sub_category'] = ['id' => request('sub_sub_category') , 'text' => SubSubCategory::find(request('sub_sub_category'))->name];
        if ( request()->filled('region')) $filteredData['region'] = ['id' => request('region') , 'text' => Country::find(request('region'))->name];
        if ( request()->filled('city')) $filteredData['city'] = ['id' => request('city') , 'text' => City::find(request('city'))->name];


        if(!empty(request()->all()))
        {
            $this->filter($auctionObj);
        }

        Cache::put('auction_filter', $filteredData, 360000);

        $data = [
            'auctions' => $auctionObj->paginate(20)
        ];
        return view('admin.auction.auction', $data);
    }

    public function editModal($id)
    {
        return view('admin.modals.auction.add_edit');
    }

    public function addEditAuction(AuctionValidator $request, $id)
    {
        $validated = $request->validator;

        if(isset($validated) && $validated->fails())
        {
            $errors = view('admin.errors.errors', ['errors'=> $validated->errors() ])->render();
            return response()->json(['status'=>'error', 'errors'=>$errors]);
        }
        else
        {
            if($id==0)
            {
                $auctionObj = new Auction();
            }
            else
            {
                $auctionObj = Auction::find($id);
            }

            $auctionObj->user_id     = auth('web')->user()->id;
            $auctionObj->title       = request('title');
            $auctionObj->description = request('tesvir');
            $auctionObj->category_id = request('category');
            $auctionObj->sub_category_id = request('sub_category');
            $auctionObj->sub_sub_category_id = request('sub_sub_category');
            if(request()->filled('start_price')) $auctionObj->start_price = request('start_price');
            $auctionObj->reserve_price  = request('reserve_price');
            $auctionObj->currency = request('currency');
            $auctionObj->increment_price   = request('increment_price');
            $auctionObj->country_id   = request('region');
            $auctionObj->city_id      = request('city');
            $auctionObj->end_date     = Carbon::parse(request('endDay'));
            $auctionObj->slug         = str_slug(request('title'), '-');
            $auctionObj->save();

            //$auctionObj->images()->detach();

            foreach (request('files') as $file) {
                $auctions = $file;
                $storagePath = Storage::disk('s3')->put("auctions", $auctions, 'public');
                $imageObj = new AuctionImage();
                $imageObj->image_path  = $storagePath;
                $imageObj->auction_id  = $auctionObj->id;
                $imageObj->save();
             }
            return response()->json(['status' => 'ok']);
        }

        return null;
    }

    public function openFilterModal(){
        $filters = null;
        if (Cache::has('auction_filter')){
            $filters = Cache::get('auction_filter');
        }

        $data = [
            'filters' => $filters
        ];

        return view('admin.auction.filter',$data);
    }

    public function rejectAuction()
    {
        $validator = validator(request()->all(), [

        ]);

        if($validator->fails())
        {

        }
        else
        {
           $rejectAuction = new RejectAuction();
           $rejectAuction->auction_id = request('auction_id');
           $rejectAuction->description = request('name');
           $rejectAuction->save();

           $auction = Auction::find(request('auction_id'));
           $auction->status = 3;
           $auction->save();

           return response()->json(['status' => 'ok']);
        }
    }

    public function confirmAuction()
    {
        $auction = Auction::find(request('auction_id'));
        $auction->status = 1;
        $auction->save();

        return response()->json(['status' => 'ok']);
    }

    public function showAuction($id)
    {
        $objAuction = Auction::find($id);

        $data = [
          'auctions' => $objAuction
        ];

        return view('admin.modals.auction.show_auction', $data);
    }

    public function filter($object)
    {
        if (request('users')) $object->whereIN('user_id', explode(',', request('users')));
        if (request('reserve_price')) $object->whereBetween('reserve_price', [request('start_price'), request('reserve_price')]);
        if (request('category')) $object->where('category_id', request('category'));
        if (request('sub_category')) $object->where('sub_category_id', request('sub_category'));
        if (request('sub_sub_category')) $object->where('sub_sub_category_id', request('sub_sub_category'));
        if (request('sub_sub_category')) $object->where('sub_sub_category_id', request('sub_sub_category'));
        if (request('region')) $object->where('country_id',  request('region'));
        if (request('city')) $object->where('city_id', request('city'));
        if (request('auction_status')) $object->whereIN('status', explode(',', request('auction_status')));

        switch (request('choose_day'))
        {
            case 'today':
                $object->whereDate('created_at', date('Y-m-d', time()));
                break;
            case 'yesterday':
                $object->whereDate('created_at', date('Y-m-d', strtotime("-1 days")));
                break;
            case 'current_week':
                $object->whereDate('created_at', date('Y-m-d', strtotime('+1 week')));
                break;
            case 'previous_week':
                $object->whereDate('created_at', date('Y-m-d', strtotime('-1 week')));
                break;
            case 'current_month':
                $object->whereDate('created_at', date('Y-m-d', strtotime('+1 month')));
                break;
            case 'previous_month':
                $object->whereDate('created_at', date('Y-m-d', strtotime('-1 month')));
                break;
            case 'last_30':
                $object->whereDate('created_at', '<=', date('Y-m-d', strtotime('-1 month')));
                break;
            case 'custom':
                $object->whereDate('created_at', '>=', date('Y-m-d', strtotime(request('start_date'))));
                $object->whereDate('created_at', '<=', date('Y-m-d', strtotime(request('end_date'))));
                break;
        }
    }
}
