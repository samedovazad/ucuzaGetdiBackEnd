<?php

namespace App\Http\Controllers\Admin\Msk;

use App\Models\Admin\AuctionStatus;
use App\Http\Controllers\Controller;

class AuctionStatusController extends Controller
{
    public function index(){
        $statuses = AuctionStatus::orderByDesc('id')->get();
        foreach ($statuses as $status){
            $status['delete_url'] = route('admin.auction_status.delete',$status->id);
        }
        $data = [
            'statuses' => $statuses
        ];
        return view('admin.msk.auction_status',$data);
    }

    public function addEditAction(){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if (request('id') == 0){
                $auctionStatusObj = new AuctionStatus();
            }
            else{
                $auctionStatusObj = AuctionStatus::find(request('id'));
            }

            $auctionStatusObj->name = request('name');
            $auctionStatusObj->color = request('color');
            $auctionStatusObj->save();

            $auctionStatusObj['delete_url'] = route('admin.auction_status.delete',$auctionStatusObj->id);

            return response()->json(['status' => 'ok','auctionStatus' => $auctionStatusObj]);
        }
    }

    public function deleteAction($id){
        $obj = AuctionStatus::find($id);
        if ($obj == null){

        }
        else{
            $obj->delete();
            return redirect()->back();
        }
    }
}
