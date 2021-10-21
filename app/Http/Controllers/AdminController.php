<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Foodchef;
use App\Models\Order;
use App\Models\Category;
use App\Models\Product;
use App\Mail\SendMail;
use Mail;
use App\Models\MultipeProduct;
class AdminController extends Controller
{
    public function user()
    {
        $data=User::all();
        return view('admin.users',compact('data'));
    }
    public function deleteuser($id)
    {
        $user=User::find($id);
        $user->delete();
        return redirect()->back();
    }
    public function foodmenu()
    {
        $data['data']=Food::all();
        return view('admin.foodmenu',$data);
    }
    public function upload(Request $request)
    {
        $data=new Food;

        $image=$request->image;
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $image->move('foodimage',$imageName);

        $data->image=$imageName;
        $data->title=$request->title;
        $data->price=$request->price;
        $data->description=$request->description;
        $data->save();
        Mail::to('asha@gmail.com')->send(new SendMail($data));
        return redirect()->back();
    }
    public function deletemenu($id)
    {
        $food=Food::find($id);
        $food->delete();
        return redirect()->back();
    }
    public function editmenu($id)
    {
        $data=Food::find($id);
        return view('admin.edit',compact('data'));
    }
    public function update(Request $request,$id)
    {
       
        $food=Food::find($id);
        $image=$request->image;
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $image->move('foodimage',$imageName);

        $food->image=$imageName;
        $food->title=$request->title;
        $food->price=$request->price;
        $food->description=$request->description;
        $food->save();

        return redirect('foodmenu');
    }
    public function reservation(Request $request)
    {
        $reservation=new Reservation;
        $reservation->name=$request->name;
        $reservation->email=$request->email;
        $reservation->phone=$request->phone;
        $reservation->guest=$request->guest;
        $reservation->date=$request->date;
        $reservation->time=$request->time;
        $reservation->message=$request->message;
        $reservation->save();
        return redirect()->back();

    }
    public function viewreservation()
    {
        $data=Reservation::all();
        return view('admin.adminreservation',compact('data'));
    }
    public function viewchef()
    {
        $data=Foodchef::all();
        return view('admin.adminchef',compact('data'));
    }
    public function storechef(Request $request)
    {
        $image=$request->image;
        $imagename=time().'.'.$image->getClientOriginalExtension();
        $image->move('foodimage',$imagename);
        $foodchef=new Foodchef;
        $foodchef->name=$request->name;
        $foodchef->speciality=$request->speciality;
        $foodchef->image=$imagename;
        $foodchef->save();
        return redirect()->back();
    }
    public function editchef($id)
    {
        $editchef=Foodchef::find($id);
        return view('admin.editchef',compact('editchef'));
    }
    public function updatechef(Request $request,$id)
    {
         $updatechef=Foodchef::find($id);
        $image=$request->image;
       
        if($image){
        $imagename=time().'.'.$image->getClientOriginalExtension();

        $image->move('foodimage',$imagename);

        $updatechef->image=$imagename;
       
        }
       
        $updatechef->name=$request->name;
        $updatechef->speciality=$request->speciality;
        $updatechef->save();
        return redirect('viewchef');

    }
    public function deletechef($id)
    {
        $deletechef=Foodchef::find($id);
       
        $deletechef->delete();
        return redirect()->back();
    }
    public function orders()
    {
        $data=Order::all();
        return view('admin.order',compact('data'));
    }
    public function search(Request $request)
    {
        $search=$request->search;
        $data=Order::where('name','LIKE','%'.$search.'%')->orwhere('foodname','LIKE','%'.$search.'%')->get();
        return view('admin.order',compact('data')); 
    }
    public function categorycreate()
    {
     
        return view('admin.category.create');
    }
    public function storecategory(Request $request)
    {
        $category=new Category;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return redirect()->back();
    }
    public function product()
    {
        $category=Category::all();
        $product=Product::with('category')->get();
        
        return view('admin.product.create',compact('category','product'));
    }
    public function storeproduct(Request $request)
    {
        $image=$request->image;
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $image->move('foodimage',$imageName);
        $product=new Product;
        $product->category_id=$request->category_id;
        $product->name=$request->name;
        $product->price=$request->price;
        $product->image=$imageName;
        $product->save();

        return redirect()->back();
    }
    public function shop()
    {
        $product=Product::all();
       // dd($product);
        return view('admin.shop.create',compact('product'));
    }
    public function fetchproduct($name)
    {
        $product=Product::where('name',$name)->with('category')->first();

             return response()->json([
                'success'=>true,
                'product' => $product,
            ]);



    }
    public function multipleproduct()
    {
        $product=Product::all();
        return view('admin.multiple.product',[
            'product'=>$product]
    );
    }
    public function multipleproductstore(Request $request)
    {
        //dd($request->all());
        //for($product_name=0;$product_name < count ($request->product_name);$product_name++)
        $kp=$request->product_name;
        foreach($kp as $key=>$value)
        {
            $multipleProduct=new MultipeProduct;
            $multipleProduct->product_name=$value;
            $multipleProduct->price=$request->price[$key];
            $multipleProduct->discount=$request->discount[$key];
            $multipleProduct->total=$request->total[$key];
            $multipleProduct->save();

            return redirect()->back();
        }
    }
}

