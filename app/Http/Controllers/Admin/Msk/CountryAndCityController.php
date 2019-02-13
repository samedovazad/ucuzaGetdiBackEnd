<?php

namespace App\Http\Controllers\Admin\Msk;

use App\Models\Admin\City;
use App\Models\Admin\Country;
use App\Http\Controllers\Controller;

class CountryAndCityController extends Controller
{
    public function index(){
        $countries = Country::orderByDesc('id')->get();
        foreach ($countries as $country){
            $country['delete_url'] = route('admin.country.delete',$country->id);
        }
        $data = [
            'countries' => $countries
        ];
        return view('admin.msk.country',$data);
    }

    public function addEditAction(){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if (request('id') == 0){
                $countryObj = new Country();
            }
            else{
                $countryObj = Country::find(request('id'));
            }

            $countryObj->name = request('name');
            $countryObj->save();

            $countryObj['delete_url'] = route('admin.country.delete',$countryObj->id);

            return response()->json(['status' => 'ok','country' => $countryObj]);
        }
    }
    public function addEditCityAction(){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if (request('id') == 0){
                $cityObj = new City();
            }
            else{
                $cityObj = City::find(request('id'));
            }

            $cityObj->name = request('name');
            $cityObj->country_id = (int) request('cat_id');
            $cityObj->save();

            $cityObj['delete_url'] = route('admin.city.delete',$cityObj->id);

            return response()->json(['status' => 'ok','city' => $cityObj]);
        }
    }

    public function loadPage(){

        $cities = City::where('country_id',request('cat_id'))->get();
        foreach ($cities as $city){
            $city['delete_url'] = route('admin.city.delete',$city->id);
        }
        $data = [
            'cities' => $cities,
            'country_id' => request('cat_id')
        ];
        return view('admin.pages.city.city',$data);
    }

    public function deleteAction($id){
        $obj = Country::find($id);
        if ($obj == null){

        }
        else{
            $obj->delete();
            return redirect()->back();
        }
    }

    public function deleteCityAction($id){
        $obj = City::find($id);
        if ($obj == null){

        }
        else{
            $obj->delete();
            return redirect()->back();
        }
    }
}
