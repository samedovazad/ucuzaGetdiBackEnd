<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\Category;
use App\Models\Admin\City;
use App\Models\Admin\Country;
use App\Http\Controllers\Controller;
use App\Models\Admin\SubCategory;
use App\Models\Admin\SubSubCategory;
use App\User;

class Select2Controller extends Controller
{
    public function index(){
        $results = [];
        if (request('param') == 'regions'){
            $regions = Country::where('name','like','%'.request('q').'%')->get();

            foreach ($regions as $region){
                $results[] = ['id' => $region->id , 'text' => $region->name];
            }
        }
        if (request('param') == 'cities' && request('region_id') != ''){
            $regions = City::where('country_id',request('region_id'))
                ->where('name','like','%'.request('q').'%')->get();
            foreach ($regions as $region){
                $results[] = ['id' => $region->id , 'text' => $region->name];
            }
        }

        if(request('param') == 'category')
        {
            $categorys = Category::where('name', 'like', '%'.request('q').'%')->get();

            foreach ($categorys as $category){
                $results[] = ['id' => $category->id , 'text' => $category->name];
            }
        }
        if(request('param') == 'sub_category' && request('category_id') != '')
        {
            $altCategorys = SubCategory::where('category_id', request('category_id'))
                ->where('name','like','%'.request('q').'%')->get();

            foreach ($altCategorys as $altCategory){
                $results[] = ['id' => $altCategory->id , 'text' => $altCategory->name];
            }
        }

        if(request('param') == 'sub_sub_category') $results = self::sub_subCategory();
        if(request('param') == 'user') $results = self::getUser();

        return response()->json(['results' => $results]);
    }

    public function getUser()
    {
        $results = [];
        $users = User::where('name', 'like', '%'.request('q').'%')->get();

        foreach ($users as $user){
            $results[] = ['id' => $user->id , 'text' => $user->name];
        }

        return $results;
    }

    public function sub_subCategory()
    {
        $results = [];

        $subCategorys = SubSubCategory::where('sub_category_id', request('sub_category_id'))
            ->where('name','like','%'.request('q').'%')->get();

        foreach ($subCategorys as $subCategory){
            $results[] = ['id' => $subCategory->id , 'text' => $subCategory->name];
        }

        return $results;
    }
}
