<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductItem;
class ResourceProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected static $material_rate=
    [
        'Purchase Rate'=>'Purchase Rate',
        'Last Purchase Rate' => 'Last Purchase Rate',
        'Price List' => 'Price List'

    ];
    public function index()
    {
        $category=Product::all();
        return view('admin.resource.index',[
            'category'=>$category
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category=Category::pluck('name','id')->toArray();
        $productData=Product::pluck('name','id')->toArray();
        //dd($productData);
        return view('admin.resource.create',[
            'category'=>$category,
            'productData'=>$productData,
            'material_rate'=>static::$material_rate,
            
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());
        $product=Product::create([
            'material_rate'=>$request->material_rate,
            'category_id'=>$request->category_id,
            'name'=>$request->name,
            'price'=>$request->price
        ]);
         $product_id=$product->id;
        
        if($product){
            for($i=0; $i< count($request->product_id); $i++)
            {
                $item=new ProductItem;
                $item->pr_id=$product_id;
                $item->product_id=$request->product_id[$i];
                $item->quantity=$request->quantity[$i];
                $item->save();
            }
        }
        return redirect()->route('resource.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category=Category::pluck('name','id')->toArray();
        $product=Product::find($id);
        //dd($product);
        $productData=Product::pluck('name','id')->toArray();
        $item=ProductItem::where('pr_id',$id)->get();
        //dd($item);
        return view('admin.resource.edit',[
            'product'=>$product,
            'category'=>$category,
            'material_rate'=>static::$material_rate,
            'productData'=>$productData,
            'item'=>$item
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $product=Product::find($id);
        //dd($product);
        $product->material_rate=$request->material_rate;
        $product->category_id=$request->category_id;
        $product->name=$request->name;
        $product->price=$request->price;
        $product->save();
        
        
       //dd($product);
        if($product){
            for($i=0;$i<count($request->product_id);$i++){
                $data=[
                    'pr_id'=>$id,
                    'product_id'=>$request->product_id[$i],
                    'quantity'=>$request->quantity[$i],
                ];
                //dd($product);
                $test=ProductItem::where('pr_id',$id)->update($data);
                /*$itemData=ProductItem::find($product);
                $itemData->pr_id=$product;
                $itemData->product_id=$request->product_id[$i];
                $itemData->quantity=$request->quantity[$i];
                $itemData->save();*/
            }
        }
        return redirect()->route('resource.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Product::find($id);
        $product->delete();
        return redirect()->route('resource.index');
    }
}
