<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use App\Models\Product\Category;
use App\Models\Settings\UnitStyle;
use App\Models\Settings\Buyer;
use Illuminate\Http\Request;
use App\Http\Requests\Product\Product\AddNewRequest;
use App\Http\Requests\Product\Product\UpdateRequest;

use Toastr;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products=Product::orderBy('id','DESC');
        if($request->name)
            $products=$products->where('name','like','%'.$request->name.'%');
        if($request->style_code)
            $products=$products->where('item_code','like','%'.$request->item_code.'%');
        if($request->item_type)
            $products=$products->where('item_type',$request->item_type);

        $products=$products->paginate(15);
        return view('product.product.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories=Category::orderBy('name')->get();
        $unitstyles=UnitStyle::orderBy('name')->get();
        $buyers=Buyer::orderBy('name')->get();
        return view('product.product.create',compact('categories','unitstyles','buyers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
        try{
            $data=new Product;
            $data->category_id=$request->category_id;
            $data->item_code=$request->item_code;
            $data->name=$request->name;
            $data->item_type=$request->item_type;
            $data->unit_price=$request->unit_price;
            $data->description=$request->description;
            $data->color=$request->color;
            $data->unit_style_id=$request->unit_style_id;
            $data->size=$request->size;
            $data->buyer_id=$request->buyer_id;
            $data->status=1;
            if($data->save())
                return redirect()->route(currentUser().'.product.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
           // dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories=Category::orderBy('name')->get();
        $unitstyles=UnitStyle::orderBy('name')->get();
        $product=Product::findOrFail(encryptor('decrypt',$id));
        return view('product.product.edit',compact('categories','unitstyles','product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $data=Product::findOrFail(encryptor('decrypt',$id));
            $data->category_id=$request->category_id;
            $data->item_code=$request->item_code;
            $data->name=$request->name;
            $data->item_type=$request->item_type;
            $data->unit_price=$request->unit_price;
            $data->description=$request->description;
            $data->color=$request->color;
            $data->unit_style_id=$request->unit_style_id;
            $data->size=$request->size;
            $data->buyer_id=$request->buyer_id;
            $data->status=1;
            if($data->save())
                return redirect()->route(currentUser().'.product.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
