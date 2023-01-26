<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Models\Product\Indent;
use App\Models\Settings\Buyer;
use App\Models\Product\Product;
use App\Models\Settings\UnitStyle;
use App\Models\Company\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Product\Indent\AddNewRequest;
use App\Http\Requests\Product\Indent\UpdateRequest;

use Toastr;

class IndentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $indents=Indent::orderBy('id','DESC')->latest();
        
        if($request->style_name){
            $pro=Product::where('name','like','%'.$request->style_name.'%')->orWhere('item_code','like','%'.$request->style_name.'%')->first();
            if($pro){
                $indents=$indents->where('product_style_id',$pro->id);
            }
        }
        if($request->indent_no)
            $indents=$indents->where('indent_no','like','%'.$request->indent_no.'%');
        if($request->buyer_id)
            $indents=$indents->where('buyer_id',$request->buyer_id);

        $indents=$indents->paginate(15);
        $buyers=Buyer::orderBy('name')->get();
        return view('product.indent.index',compact('indents','buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $prostyles=Product::where('item_type',1)->orderBy('name','ASC')->get();
        $unitstyles=UnitStyle::orderBy('name','ASC')->get();
        $buyers=Buyer::orderBy('name')->get();
        return view('product.indent.create',compact('prostyles','unitstyles','companies','buyers'));
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
            $data=new Indent;
            $data->product_style_id=$request->product_style_id;
            $data->unit_style_id=$request->unit_style_id;
            $data->indent_no=$request->indent_no;
            $data->qty=$request->qty;
            $data->weight=$request->weight;
            $data->unit_price=$request->unit_price;
            $data->description=$request->description;
            $data->buyer_id=$request->buyer_id;
            $data->order_date=$request->order_date;
            $data->start_date=$request->start_date;
            $data->finish_date=$request->finish_date;
            $data->actual_finish_date=$request->actual_finish_date;
            $data->status=1;
            $data->company_id=$request->company_id;
            $data->created_by=currentUserId();
            if($data->save()){
                \LogActivity::addToLog('Add Indent',$request->getContent(),'Indent');
                return redirect()->route(currentUser().'.indent.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\Indent  $indent
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\Indent  $indent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $prostyles=Product::where('item_type',1)->orderBy('name','ASC')->get();
        $unitstyles=UnitStyle::orderBy('name','ASC')->get();
        $indent=Indent::findOrFail(encryptor('decrypt',$id));
        $buyers=Buyer::orderBy('name')->get();
        return view('product.indent.edit',compact('prostyles','unitstyles','indent','companies','buyers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\Indent  $indent
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $data=Indent::findOrFail(encryptor('decrypt',$id));
            $data->product_style_id=$request->product_style_id;
            $data->unit_style_id=$request->unit_style_id;
            $data->indent_no=$request->indent_no;
            $data->qty=$request->qty;
            $data->weight=$request->weight;
            $data->unit_price=$request->unit_price;
            $data->description=$request->description;
            $data->buyer_id=$request->buyer_id;
            $data->order_date=$request->order_date;
            $data->start_date=$request->start_date;
            $data->finish_date=$request->finish_date;
            $data->actual_finish_date=$request->actual_finish_date;
            $data->status=$request->status;
            $data->company_id=$request->company_id;
            $data->updated_by=currentUserId();
            if($data->save()){
                \LogActivity::addToLog('Update Indent',$request->getContent(),'Indent');
                return redirect()->route(currentUser().'.indent.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\Indent  $indent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
