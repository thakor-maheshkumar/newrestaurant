<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Food;
use App\Models\Reservation;
use App\Models\Foodchef;
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
}
