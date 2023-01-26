<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Models\Product\ProductStyleDetails;
use App\Models\Product\Product;
use App\Models\Settings\UnitStyle;
use Illuminate\Http\Request;
use DB;
use Toastr;

class ProductStyleDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $psd=ProductStyleDetails::where('product_style_id',encryptor('decrypt',$request->styleid))->latest()->get();
        $style_id=$request->styleid;
        return view('product.productstyle.detailindex',compact('psd','style_id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $ps=Product::findOrFail(encryptor('decrypt',$request->styleid));
        $psd=ProductStyleDetails::where('product_style_id',encryptor('decrypt',$request->styleid))->pluck('product_id')->toArray();
       
        return view('product.productstyle.detailcreate',compact('ps','psd'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_sc(Request $request)
    {
        if($request->name){
            if($request->oldpro)
                $product=DB::select("SELECT id,name,item_code FROM `products` WHERE  item_type in (3,4) and item_code like '". $request->name ."%' and id not in (".ltrim($request->oldpro,',').") and status=1");
            else
                $product=DB::select("SELECT id,name,item_code FROM `products` WHERE item_type in (3,4) and item_code like '". $request->name ."%' and status=1");
        
            print_r(json_encode($product));  
        }
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_sc_d(Request $request)
    {
        if($request->item_id){
            $product=DB::select("SELECT * FROM `products` WHERE id=".$request->item_id."");
            $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
            
            $data='<tr class="productlist">';
            $data.='<td>'.$product[0]->item_code.'-'.$product[0]->name.'<input name="product_id[]" type="hidden" value="'.$product[0]->id.'" class="product_id_list"></td>';
            $data.='<td>
                        <select class="form-control form-select choices'.$product[0]->id.' unit_style_id w-25" name="unit_style_id[]">';
                            if($unitstyles){
                                foreach($unitstyles as $us){
                                    $selected="";
                                    if($us->id==$product[0]->unit_style_id)
                                            $selected="selected";
                                    $data.='<option '.$selected.' value="'.$us->id.'">'.$us->name.'</option>';
                                }
                            }
            $data.='</select></td>';
            $data.='<td><input name="qty[]" type="text" class="form-control qty" value="0"></td>';
            $data.='<td><input name="weight[]" type="text" class="form-control weight" value="0"></td>';
            $data.='<td><input name="description[]" type="text" class="form-control description" value=""></td>';
            $data.='<td class="text-danger"><i style="font-size:1.2rem" onclick="removerow(this)" class="bi bi bi-trash"></i></td>';
            $data.='</tr>';
            $return=array('data'=>$data,'choice'=>'choices'.$product[0]->id);
            print_r(json_encode($return));  
        }
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        try{
            if($request->product_id){
                foreach($request->product_id as $i=>$product_id){
                    $psd=new ProductStyleDetails;
                    $psd->product_style_id=$request->product_style_id;
                    $psd->product_id=$product_id;
                    $psd->unit_style_id=$request->unit_style_id[$i];
                    $psd->qty=$request->qty[$i];
                    $psd->weight=$request->weight[$i];
                    $psd->description=$request->description[$i];
                    $psd->status=1;
                    $psd->save();
                }
                DB::commit();
                return redirect(currentUser()."/productstyledetails?styleid=".encryptor('encrypt',$request->product_style_id))->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            DB::rollback();
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product\ProductStyleDetails  $productStyleDetails
     * @return \Illuminate\Http\Response
     */
    public function show(ProductStyleDetails $productStyleDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product\ProductStyleDetails  $productStyleDetails
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
        $psd=ProductStyleDetails::findOrFail(encryptor('decrypt',$id));
        $ps=Product::findOrFail($psd->product_style_id);
        $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
        return view('product.productstyle.detailedit',compact('ps','psd','unitstyles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product\ProductStyleDetails  $productStyleDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $psd=ProductStyleDetails::findOrFail(encryptor('decrypt',$id));
            $psd->unit_style_id=$request->unit_style_id;
            $psd->qty=$request->qty;
            $psd->weight=$request->weight;
            $psd->description=$request->description;
            if($psd->save()){
                return redirect(currentUser()."/productstyledetails?styleid=".encryptor('encrypt',$request->product_style_id))->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product\ProductStyleDetails  $productStyleDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try{
            $psd = ProductStyleDetails::findOrFail(encryptor('decrypt',$id));
            if($psd->delete()){
                return redirect()->back()->with(Toastr::success('Data Deleted!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            return redirect()->back()->with($this->resMessageHtml(false,'error','Please try again'));
        }
        
    }
}
