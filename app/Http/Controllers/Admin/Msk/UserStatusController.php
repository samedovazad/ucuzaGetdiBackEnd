<?php

namespace App\Http\Controllers\Admin\Msk;


use App\Http\Controllers\Controller;
use App\Models\Admin\UserStatus;

class UserStatusController extends Controller
{
    public function index(){
        $statuses = UserStatus::orderByDesc('id')->get();
        foreach ($statuses as $status){
            $status['delete_url'] = route('admin.user_status.delete',$status->id);
        }
        $data = [
            'statuses' => $statuses
        ];
        return view('admin.msk.user_status',$data);
    }
    public function addEditAction(){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if (request('id') == 0){
                $userStatusObj = new UserStatus();
            }
            else{
                $userStatusObj = UserStatus::find(request('id'));
            }

            $userStatusObj->name = request('name');
            $userStatusObj->color = request('color');
            $userStatusObj->save();

            $userStatusObj['delete_url'] = route('admin.user_status.delete',$userStatusObj->id);

            return response()->json(['status' => 'ok','userStatus' => $userStatusObj]);
        }
    }

    public function deleteAction($id){
        $obj = UserStatus::find($id);
        if ($obj == null){

        }
        else{
            $obj->delete();
            return redirect()->back();
        }
    }
}
