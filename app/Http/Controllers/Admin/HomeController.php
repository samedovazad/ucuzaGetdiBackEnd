<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index(){
        return view('admin.home');
    }

    public function changeLang($locale)
    {
        $cookie = cookie('locale', $locale, 45000);
        return redirect()->back()->cookie($cookie);
    }
}
