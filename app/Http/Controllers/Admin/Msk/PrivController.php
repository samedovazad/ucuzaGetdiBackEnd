<?php

namespace App\Http\Controllers\Admin\Msk;

use App\Models\Admin\Group;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PrivController extends Controller
{
    public function index(){
        $groups = Group::all();
        $data = [
          'groups' => $groups
        ];
        return view('admin.msk.priv',$data);
    }

    public function addEditModal($id){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if ($id == 0){
                $groupObj = new Group();
            }
            else{
                $groupObj = Group::find($id);
            }

            $data = [
              'group' => $groupObj,
              'id' => $id
            ];

            return view('admin.modals.msk.priv_add_edit',$data);
        }
    }

    public function addEditAction($id){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if ($id == 0){
                $groupObj = new Group();
            }
            else{
                $groupObj = Group::find($id);
            }

            $groupObj->group_name = request('group_name');
            $groupObj->aviable_modules = json_encode(request('available_modules'));
            $groupObj->save();

            return response()->json(['status' => 'ok']);
        }
    }
}
