<?php

namespace App\Http\Controllers\Product;
use App\Http\Controllers\Controller;

use App\Models\Product\IndentDetails;
use App\Models\Product\Indent;
use App\Models\Product\Product;
use App\Models\Settings\UnitStyle;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportFromExce;

use DB;
use Toastr;

class IndentDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $psd=IndentDetails::where('indent_id',encryptor('decrypt',$request->indent_id))->orderBy('id')->get();
        $indent_id=$request->indent_id;
        return view('product.indent.detailindex',compact('psd','indent_id'));
    }

    /**
     * Show the form for creating a new resource.
     * First screen to create 
     * accept excel file or product style or go to regular input
     */
    public function createinput(Request $request){
        $ps=Indent::findOrFail(encryptor('decrypt',$request->indent_id));
       
        return view('product.indent.detailcreateinput',compact('ps'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request){
        $ps=Indent::findOrFail(encryptor('decrypt',$request->indent_id));
        $psd=IndentDetails::where('indent_id',encryptor('decrypt',$request->indent_id))->pluck('product_id')->toArray();
       
        return view('product.indent.detailcreate',compact('ps','psd'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function upexcel(Request $request){
        $ps=Indent::findOrFail(encryptor('decrypt',$request->indent_id));
        $psd=IndentDetails::where('indent_id',encryptor('decrypt',$request->indent_id))->pluck('product_id')->toArray();
       
        return view('product.indent.detailcreateexcel',compact('ps','psd'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_sc(Request $request){
        if($request->name){
            if($request->oldpro)
                $product=DB::select("SELECT id,name,item_code FROM `products` WHERE  item_type in (3,4) and item_code like '". $request->name ."%' and id not in (".rtrim($request->oldpro,',').") and status=1");
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
    public function product_sc_d(Request $request){
        if($request->item_id){
            $product=DB::select("SELECT * FROM `products` WHERE id=".$request->item_id." and item_type in (3,4)");
            $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
            
            $data='<tr class="productlist">';
            $data.='<td>'.$product[0]->name.'<input name="product_id[]" type="hidden" value="'.$product[0]->id.'" class="product_id_list"></td>';
            $data.='<td>
                        <select class="form-control form-select choices'.$product[0]->id.' unit_style_id" name="unit_style_id[]">';
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
            $data.='<td><input name="price[]" type="text" class="form-control price" value="0"></td>';
            $data.='<td><input name="weight[]" type="text" class="form-control weight" value="0"></td>';
            $data.='<td><input name="description[]" type="text" class="form-control description" value=""></td>';
            $data.='<td class="text-danger"><i style="font-size:1.2rem" onclick="removerow(this)" class="bi bi bi-trash"></i></td>';
            $data.='</tr>';
            $return=array('data'=>$data,'choice'=>$product[0]->id);
            print_r(json_encode($return));  
        }
    }
    /**
     * get uploaded excel file and get ready the data
     */
    public function product_sc_excel(Request $request){
        $total_data=0;
        $data="";
        $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
        $exceldata = Excel::toArray(new ImportFromExce(), $request->file);
        if(count($exceldata)>0){
            $total_data=count($exceldata);
            $semifinishid=0;
            foreach($exceldata[0] as $d){
                $pro=DB::select("SELECT id,item_code,name,item_type,unit_style_id FROM `products` WHERE item_code='".$d[0]."' and item_type in (3,4)");
                if($pro){
                    $p=$pro[0];
                    
                    $data.='<tr class="productlist">';
                    $data.='<td>('.$p->item_code.') '.$p->name.'<input name="product_id[]" type="hidden" value="'.$p->id.'" class="product_id_list"></td>';
                    $data.='<td>
                                <select class="form-control form-select unit_style_id" name="unit_style_id[]">';
                                    if($unitstyles){
                                        foreach($unitstyles as $us){
                                            $selected="";
                                            if($us->id==$p->unit_style_id)
                                                    $selected="selected";
                                            $data.='<option '.$selected.' value="'.$us->id.'">'.$us->name.'</option>';
                                        }
                                    }
                    $data.='</select></td>';
                    $data.='<td><input name="qty[]" type="text" class="form-control qty" value="'.$d[3].'"></td>';
                    $data.='<td><input name="price[]" type="text" class="form-control price" value="'.$d[4].'"></td>';
                    $data.='<td><input name="weight[]" type="text" class="form-control weight" value="0"></td>';
                    $data.='<td><input name="description[]" type="text" class="form-control description" value="'.$d[5].'"></td>';
                    $data.='<td class="text-danger"><i style="font-size:1.2rem" onclick="removerow(this)" class="bi bi bi-trash"></i></td>';
                    $data.='</tr>';
                    
                }
            }
        }else{
            $msg="Your excel file dose not contain valid data";
        }
        print_r(json_encode($data));
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
                    $psd=new IndentDetails;
                    $psd->indent_id=$request->indent_id;
                    $psd->product_id=$product_id;
                    $psd->unit_style_id=$request->unit_style_id[$i];
                    $psd->qty=$request->qty[$i];
                    $psd->weight=$request->weight[$i];
                    $psd->price=$request->price[$i];
                    $psd->description=$request->description[$i];
                    $psd->status=1;
                    $psd->created_by=currentUserId();
                    $psd->save();
                }
                \LogActivity::addToLog('Add Indent product',$request->getContent(),'IndentDetails');
                DB::commit();
                return redirect(currentUser()."/indentdetails?indent_id=".encryptor('encrypt',$request->indent_id))->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\IndentDetails  $indentDetails
     * @return \Illuminate\Http\Response
     */
    public function show(IndentDetails $indentDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndentDetails  $indentDetails
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $psd=IndentDetails::findOrFail(encryptor('decrypt',$id));
        $ps=Indent::findOrFail($psd->indent_id);
        $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
        return view('product.indent.detailedit',compact('ps','psd','unitstyles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndentDetails  $indentDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $psd=IndentDetails::findOrFail(encryptor('decrypt',$id));
            $psd->unit_style_id=$request->unit_style_id;
            $psd->qty=$request->qty;
            $psd->weight=$request->weight;
            $psd->price=$request->price;
            $psd->description=$request->description;
            $psd->updated_by=currentUserId();
            if($psd->save()){
                \LogActivity::addToLog('Update Indent product',$request->getContent(),'IndentDetails');
                return redirect(currentUser()."/indentdetails?indent_id=".encryptor('encrypt',$request->indent_id))->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\IndentDetails  $indentDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        try{
            $psd = IndentDetails::findOrFail(encryptor('decrypt',$id));
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
