<?php

namespace App\Http\Controllers\Admin\Msk;

use App\Models\Admin\Category;
use App\Http\Controllers\Controller;
use App\Models\Admin\SubCategory;
use App\Models\Admin\SubSubCategory;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::orderByDesc('id')->get();

        foreach ($categories as $categorie)
        {
            $categorie['delete_url'] = route('admin.category.delete', $categorie->id);
        }

        $data = [
            'categories' => $categories
        ];
        return view('admin.msk.category',$data);
    }

    public function addEditAction(){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if (request('id') == 0){
                $categoryObj = new Category();
            }
            else{
                $categoryObj = Category::find(request('id'));
            }

            $categoryObj->name = request('name');
            $categoryObj->icon = request('icon');
            $categoryObj->save();

            $categoryObj['delete_url'] = route('admin.category.delete', $categoryObj->id);

            return response()->json(['status' => 'ok','category' => $categoryObj]);
        }
    }

    public function deleteAction($id)
    {
        $obj = Category::find($id);

        if($obj == null)
        {

        }
        else
        {
            $obj->delete();
            return redirect()->back();
        }
    }

    public function addEditSubCategoryAction(){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if (request('id') == 0){
                $categoryObj = new SubCategory();
            }
            else{
                $categoryObj = SubCategory::find(request('id'));
            }

            $categoryObj->name = request('name');
            $categoryObj->icon = request('icon');
            $categoryObj->category_id = request('cat_id');
            $categoryObj->save();

            $categoryObj['delete_url'] = route('admin.sub_category.delete', $categoryObj->id);

            return response()->json(['status' => 'ok','category' => $categoryObj]);
        }
    }

    public function loadPage(){

        $sub_categories = SubCategory::where('category_id',request('cat_id'))->get();

        foreach ($sub_categories as $sub_categorie)
        {
            $sub_categorie['delete_url'] = route('admin.sub_category.delete', $sub_categorie->id);
        }

        $data = [
            'sub_categories' => $sub_categories,
            'category_id' => request('cat_id')
        ];
        return view('admin.pages.sub_category.sub_category',$data);
    }

    public function deleteSubCategoryAction($id)
    {
        $obj = SubCategory::find($id);

        if($obj == null)
        {

        }
        else
        {
            $obj->delete();
            return redirect()->back();
        }
    }

    public function SubloadPage()
    {
        $sub_sub_categories = SubSubCategory::where('sub_category_id', request('cat_id'))->get();

        foreach ($sub_sub_categories as $sub_sub_categorie)
        {
            $sub_sub_categorie['delete_url'] = route('admin.sub_sub_category.delete', $sub_sub_categorie->id);
        }

        $data = [
            'sub_categories'  => $sub_sub_categories,
            'sub_category_id' => request('cat_id')
        ];

        return view('admin.pages.sub_category.sub_sub_category', $data);
    }

    public function addEditSubSubCategoryAction(){
        $validator = validator(request()->all(),[

        ]);

        if ($validator->fails()){

        }
        else{
            if (request('id') == 0){
                $categoryObj = new SubSubCategory();
            }
            else{
                $categoryObj = SubSubCategory::find(request('id'));
            }

            $categoryObj->name = request('name');
            $categoryObj->icon = request('icon');
            $categoryObj->sub_category_id = request('cat_id');
            $categoryObj->save();

            $categoryObj['delete_url'] = route('admin.sub_sub_category.delete', $categoryObj->id);

            return response()->json(['status' => 'ok','category' => $categoryObj]);
        }
    }

    public function deleteSubSubCategoryAction($id)
    {
        $obj = SubSubCategory::find($id);

        if($obj == null)
        {

        }
        else
        {
            $obj->delete();
            return redirect()->back();
        }
    }
}
