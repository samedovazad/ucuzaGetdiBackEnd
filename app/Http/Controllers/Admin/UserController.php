<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Standarts;
use App\Http\Requests\UserValidator;
use App\Models\Admin\City;
use App\Models\Admin\Country;
use App\User;
use Carbon\Carbon;
use Hash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::type('ADMIN')->get();
        $admins = User::type('USER')->get();

        $data = [
            'admins' => $admins,
            'users' => $users
        ];

        return view('admin.users.users', $data);

    }

    public function addEditModal($id)
    {
        $validator = validator(request()->all(), [

        ]);

        if ($validator->fails()) {

        } else {
            if($id == 0){
                $userObj = new User();
            }else{
                $userObj = User::find($id);
            }
            $select2Data = [
                'regions' => ['id' => $userObj->region_id , 'text' => Country::find($userObj->region_id)['name']],
                'cities' => ['id' => $userObj->city_id , 'text' => City::find($userObj->city_id)['name']]
            ];

            $data = [
                'user' => $userObj,
                'id' => $id,
                'select2Data' => $select2Data
            ];

            return view('admin.modals.users.add_edit',$data);
        }
    }

    public function addEditAction(UserValidator $request, $id)
    {
        $validated = $request->validator;

        if(isset($validated) && $validated->fails())
        {
            $errors = view('admin.errors.errors', ['errors'=> $validated->errors() ])->render();
            return response()->json(['status'=>'error', 'errors'=>$errors]);
        }
        else{
            if ($id == 0){
                $userObj = new User();
            }
            else{
                $userObj = User::find($id);
            }

            $userObj->email = request('email');
            $userObj->username = request('username');
            $userObj->name = request('name');
            $userObj->surname = request('surname');
            $userObj->region_id = request('region');
            $userObj->city_id = request('city');
            $userObj->first_phone = request('fphone');
            $userObj->second_phone = request('fphone');
            $userObj->address = request('address');
            $userObj->gender = request('gender');
            $userObj->birthday = Carbon::parse(request('birthday'));
            $userObj->group_id = request('group_id');
            $userObj->user_type = Standarts::user_types['ADMIN'];

            if (request()->filled('password')){
                $userObj->password = Hash::make(request('password'));
            }
            if (request()->hasFile('avatar_file')){

                $avatarFile = request()->file('avatar_file');
                $storagePath = Storage::disk('s3')->put("avatars",$avatarFile,'public');
                $userObj->avatar = $storagePath;
            }

            $userObj->save();

            return response()->json(['status' => 'ok']);
        }
    }

    public function makeActive($id){
        $userObj = User::find($id);
        if ($userObj == null){
            return redirect()->back();
        }
        $userObj->is_active = 1;
        $userObj->save();
        return redirect()->back();
    }

}
