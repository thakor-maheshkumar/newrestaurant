<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Foodchef;
class HomeController extends Controller
{
    public function index()
    {
        $chef=Foodchef::all();
        $data=Food::all();
        return view('home',compact('data','chef'));
    }
    public function redirects()
    {   
        $data=Food::all();
        $chef=Foodchef::all();
        $usertype=Auth::user()->usertype;

        if($usertype==1)
        {
            return view('admin.adminhome');
        }else{
            return view('home',compact('data','chef'));
        }
    }
}
