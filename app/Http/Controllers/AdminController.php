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
use App\Mail\MultipleMail;
use App\Mail\SingleMail;
use Mail;
use App\Events\PostCreated;
use App\Models\MultipeProduct;
use DataTables;
use App\Events\FoodEvent;
use App\Events\MultipleEvent;
use App\Mail\ProductEmail;
use Auth;
use Notification;
use App\Notifications\OffersNotification;
use DB;
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
       // Mail::to('asha@gmail.com')->send(new SendMail($data));
        event(new FoodEvent($data));
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
        event(new PostCreated($foodchef));
        //PostCreated::dispatch($foodchef);
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
        $category=Category::pluck('name','id')->toArray();
        //dd($category);
        $product=Product::all();
         //dd($product);   
        return view('admin.product.create',[
            'category'=>$category,
            'product'=>$product
        ]);
    }
    public function storeproduct(Request $request)
    {
        $userSchema=Auth::user();
        $image=$request->image;
        $imageName=time().'.'.$image->getClientOriginalExtension();
        $image->move('foodimage',$imageName);
        $product=new Product;
        $product->category_id=$request->category_id;
        $product->name=$request->name;
        $product->price=$request->price;
        $product->image=$imageName;
       /* Mail::to('cs@gmail.com')->send(new ProductEmail($product));*/
        
        $product->save();
        //Notification::send($userSchema, new OffersNotification($product));
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
    public function multipleproduct(Request $request)
    {
        $product=Product::all();
        if($request->ajax()){

            $data=MultipeProduct::with('product');
            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action',function($row){
                    $btn = '<a href="javascript:void(0)" class="view btn btn-primary btn-sm">View</a>';
                    $edit = '<a href="#"  type="button" class="editData btn btn-success btn-sm" data-id='.$row->id.'>edit</a>';
                    return $btn .$edit;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
        return view('admin.multiple.product',[
            'product'=>$product]
    );
    }
    public function multipleproductstore(Request $request)
    {
        //dd($request->all());
        //for($product_name=0;$product_name < count ($request->product_name);$product_name++)
        //$kp=$request->product_name;
        for($i=0; $i < count($request->product_name);$i++)
        {
            //dd($value);
            $multipleProduct=new MultipeProduct();
            $multipleProduct->product_name=$request['product_name'][$i];
            $multipleProduct->price=$request['price'][$i];
            $multipleProduct->discount=$request['discount'][$i];
            $multipleProduct->total=$request['total'][$i];
            $multipleProduct->save();

            //
          }
            //Mail::to('am@gmail.com')->send(new MultipleMail());
           //Mail::to('test@gmail.com')->send(new SingleMail($multipleProduct));
            event(new MultipleEvent($multipleProduct));
            return redirect()->back();
        
    }
    public function editproduct(Request $request)
    {
        $data=MultipeProduct::where('id',$request->id)->with('product')->first();
        return response()->json([
            'data'=>$data,
        ]);
    }
    public function updatemultiple(Request $request)
    {
        //dd($request->all());
        $id=$request->id;
        $multipleProductupdate=MultipeProduct::find($id);
        
        $multipleProductupdate->product_name=$request->product_name ?? 5;
        $multipleProductupdate->price=$request->price;
        $multipleProductupdate->discount=$request->discount;
        $multipleProductupdate->total=$request->total;
        $multipleProductupdate->save();
        return json_encode(array('statusCode'=>200));
    }
    public function groupby()
    {
        $multiple=MultipeProduct::select("*",DB::raw("count(*) as total"))
                                ->groupBy('country')
                                ->get();
        dd($multiple);
       return view('admin.groupby',[
        'multiple'=>$multiple
       ]);
        
    }
    public function productEdit($id)
    {
        $category=Category::pluck('name','id')->toArray();
        $productjk=Product::with('category')->find($id);
        $product=Product::all();
        //dd($product);
        return view('admin.product.create',[
            'productjk'=>$productjk,
            'category'=>$category,
            'product'=>$product
        ]);
    }
}


/*$id_purchase=$data->id;
            if(isset($_POST['id_raw_product'])){
                foreach($_POST['id_raw_product'] as $key=>$id_raw_product):
                    $detail=new PurchaseD();
                    $detail->id_purchase=$data->id;
                    $detail->id_product=$id_raw_product;
                    $detail->total=$_POST['total'][$key];
                    $detail->price=$_POST['price'][$key];
                    $total=$total+( $detail->total * $detail->price);
                    $detail->save();
                endforeach;
            }*/
