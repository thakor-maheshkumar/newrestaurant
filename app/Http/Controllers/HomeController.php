<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Foodchef;
use App\Models\Cart;
use App\Models\Order;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id()){
            return redirect('redirects');
        }
        else
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
            $user_id=Auth::id();
            $count=Cart::where('user_id',$user_id)->count();

            return view('home',compact('data','chef','count'));
        }
    }
    public function addcart(Request $request)
    {
        if(Auth::id())
        {
            $cart=new Cart;
            $cart->user_id=Auth::id();
            $cart->food_id=$request->food_id;
            $cart->quantity=$request->quantity;
            $cart->save();
            return redirect()->back()->with('message','Your product has been addedd succesfully');
        }
        else{
            return redirect('login');
        }
    }
    public function showcart(Request $request,$id)
    {
        
        if(Auth::id()==$id){
            $count=Cart::where('user_id',$id)->count();
        /*$join=Food::join('carts','food.id','=','carts.food_id')
                    ->select('food.title','food.price','carts.quantity')
                    ->where('')
                    ->get();*/
        $join=Cart::join('food','carts.food_id','=','food.id')
                    ->where('user_id',$id)
                    ->select('food.title','food.price','food.image','carts.quantity','carts.id')
                    ->get();
        return view('showcart',compact('count','join'));    
        }else{
            return redirect()->back();
        }
        
    }
    public function remove($id)
    {

        $cart=Cart::find($id);
        $cart->delete();
        return redirect()->back();

    }
    public function orderconfirm(Request $request)
    {
        
        foreach($request->foodname as $key=>$foodname)
        {

            $order=new Order;
            $order->foodname=$foodname;
           
            $order->price=$request->price[$key];
            $order->quantity=$request->quantity[$key];
            $order->image=$request->image[$key];
            $order->name=$request->name;
            $order->phone=$request->phone;
            $order->address=$request->address;

            $order->save();
        }
        return redirect()->back();
    }
}
