<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Models\Product\Product;
use App\Models\Settings\Buyer;
use App\Models\Settings\UnitStyle;
use Illuminate\Http\Request;
use App\Http\Requests\Product\ProductStyle\AddNewRequest;
use App\Http\Requests\Product\ProductStyle\UpdateRequest;

use Toastr;

class ProductStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $productstyles=Product::where('item_type',1)->latest();
        if($request->name)
            $productstyles=$productstyles->where('name','like','%'.$request->name.'%');
        if($request->item_code)
            $productstyles=$productstyles->where('item_code','like','%'.$request->item_code.'%');
        if($request->buyer_id)
            $productstyles=$productstyles->where('buyer_id',$request->buyer_id);

        $productstyles=$productstyles->paginate(15);
        $buyers=Buyer::orderBy('name')->get();
        
        return view('product.productstyle.index',compact('productstyles','buyers'));
    }
}