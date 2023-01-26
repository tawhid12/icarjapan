<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;

use App\Models\Stock\Requisition;
use App\Models\Stock\RequisitionDetails;
use Illuminate\Http\Request;
use App\Models\Product\Indent;
use App\Models\Company\Company;
use App\Models\Product\Product;
use App\Models\Company\Warehouse;
use App\Models\Company\WarehouseBoard;
use App\Models\Stock\ProductOutStock;
use App\Models\Stock\ProductStock;
use App\Http\Requests\Stock\Requisition\AddNewRequest;
use App\Http\Requests\Stock\Requisition\UpdateRequest;

use DB;
use Toastr;
use Carbon\Carbon;


class RequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions=Requisition::where(company())->latest()->paginate(15);
        return view('stock.requisition.index',compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $indents=Indent::select('id','indent_no','qty','company_id','product_style_id')->where('status',1)->orderBy('indent_no','ASC')->get();

        return view('stock.requisition.create',compact('indents','companies'));
    }
    /**
     * Get product style by indent
     */
    public function get_product_style(Request $request){
        $product_id=$request->style;
        $product=Product::select('id','name','item_code')->where('id',$product_id)->first();
        
        print_r(json_encode($product));
    }
    /**
     * Search product
     */
    public function product_sc(Request $request){
        $ind=$request->indent_id;
        $wherenot="";
        if($request->oldpro){
            $wherenot=" and p.id not in (".rtrim($request->oldpro,',').")";
        }
        if($request->name){
            $product=DB::select("SELECT p.id,p.name,p.item_code FROM `products` as p join indent_details on indent_details.product_id=p.id WHERE p.item_type in (3,4) and p.item_code like '". $request->name ."%' and p.status=1 $wherenot");
           // if(empty($product)) // if product not found then check semifinish product
                //$product=DB::select("SELECT DISTINCT p.id,p.name,p.item_code FROM `products` as p join indent_details on indent_details.semi_finish_product_id=p.id WHERE p.item_type = 2 and p.item_code like '". $request->name ."%' and p.status=1 $wherenot");
            
            print_r(json_encode($product));  
        }
    }
    /**
     * get product input fields with details
     */
    public function product_sc_d(Request $request){
        if($request->item_id){
            $requested_qty=0;
            $product=DB::select("SELECT * FROM `products` WHERE id=".$request->item_id."");
            $product_qty=DB::select("SELECT qty FROM `indent_details` WHERE indent_id='".$request->indent_id."' and product_id='".$request->item_id."'");
            $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
            if($product_qty){
                $product_qty=$product_qty[0]->qty;
                $requested_qty=$product_qty* $request->qty;
            }
            $data='<tr class="productlist">';
            $data.='<td>'.$product[0]->item_code.' - '.$product[0]->name.'<input name="product_id[]" type="hidden" value="'.$product[0]->id.'" class="product_id_list"></td>';
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
            $data.='<td><input name="spec[]" type="text" class="form-control spec" value=""></td>';
            $data.='<td><input name="color[]" type="text" class="form-control color" value=""></td>';
            $data.='<td><input name="qty[]" type="text" class="form-control qty" value="'.$requested_qty.'"></td>';
            $data.='<td><input name="remarks[]" type="text" class="form-control remarks" value=""></td>';
            $data.='<td class="text-danger"><i style="font-size:1.2rem" onclick="removerow(this)" class="bi bi bi-trash"></i></td>';
            $data.='</tr>';
            $return=array('data'=>$data,'choice'=>$product[0]->id);
            print_r(json_encode($return));  
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
        DB::beginTransaction();
        try{
            $data=new Requisition;
            $data->company_id=$request->company_id;
            $data->indent_id=$request->indent_id;
            $data->product_style_id=$request->product_style_id;
            $data->req_date=$request->req_date;
            $data->qty=$request->qty_total;
            $data->slip_no=$request->slip_no;
            $data->line_no=$request->line_no;
            $data->issue_by=$request->issue_by;
            $data->received_by=$request->received_by;
            $data->delivary_by=$request->delivary_by;
            $data->remarks=$request->remarks_r;
            $data->created_by=currentUserId();
            $data->status=0;
            if($data->save()){
                if($request->product_id){
                    foreach($request->product_id as $i=>$product_id){
                        $reqd=new RequisitionDetails;
                        $reqd->requisition_id=$data->id;
                        $reqd->indent_id=$request->indent_id;
                        $reqd->product_id=$product_id;
                        $reqd->company_id=$request->company_id;
                        $reqd->unit_style_id=$request->unit_style_id[$i];
                        $reqd->qty=$request->qty[$i];
                        $reqd->req_date=$request->req_date;
                        $reqd->spec=$request->spec[$i];
                        $reqd->color=$request->color[$i];
                        $reqd->remarks=$request->remarks[$i];
                        $reqd->created_by=currentUserId();
                        $reqd->status=0;
                        $reqd->save();
                    }
                    DB::commit();
                    \LogActivity::addToLog('Add Requisition',$request->getContent(),'Requisition,RequisitionDetails');
                    return redirect(currentUser()."/requisition")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
                }else{
                    return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $data=Requisition::findOrFail(encryptor('decrypt',$id));
        $datadetails=RequisitionDetails::where('requisition_id',encryptor('decrypt',$id));
        return view('stock.requisition.show',compact('data','datadetails'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=Requisition::findOrFail(encryptor('decrypt',$id));
        return view('stock.requisition.edit',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $data=Requisition::findOrFail(encryptor('decrypt',$id));
            $data->slip_no=$request->slip_no;
            $data->line_no=$request->line_no;
            $data->issue_by=$request->issue_by;
            $data->received_by=$request->received_by;
            $data->delivary_by=$request->delivary_by;
            $data->remarks=$request->remarks_r;
            $data->updated_by=currentUserId();
            $data->status=$request->status;
            if($data->save()){
                if($request->product_id){
                    foreach($request->product_id as $i=>$product_id){
                        $reqd=new RequisitionDetails;
                        $reqd->requisition_id=$data->id;
                        $reqd->indent_id=$data->indent_id;
                        $reqd->product_id=$product_id;
                        $reqd->company_id=$data->company_id;
                        $reqd->warehouse_id=$data->warehouse_id;
                        $reqd->unit_style_id=$request->unit_style_id[$i];
                        $reqd->qty=$request->qty[$i];
                        $reqd->req_date=$data->req_date;
                        $reqd->spec=$request->spec[$i];
                        $reqd->color=$request->color[$i];
                        $reqd->remarks=$request->remarks[$i];
                        $reqd->created_by=currentUserId();
                        $reqd->status=0;
                        $reqd->save();
                    }
                    DB::commit();
                }else{
                    DB::commit();
                }
                \LogActivity::addToLog('Update Requisition',$request->getContent(),'Requisition,RequisitionDetails');
                return redirect(currentUser()."/requisition")->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
        
        
        try{
            $data=Requisition::findOrFail(encryptor('decrypt',$id));
            //$data->qty=$request->qty_total;
            $data->slip_no=$request->slip_no;
            $data->line_no=$request->line_no;
            $data->issue_by=$request->issue_by;
            $data->received_by=$request->received_by;
            $data->delivary_by=$request->delivary_by;
            $data->remarks=$request->remarks_r;
            $data->updated_by=currentUserId();
            $data->status=$request->status;
            if($data->save()){
                
                return redirect(currentUser()."/requisition")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Show all pending requisition
     *
     */
    public function pending_requisition(Request $request)
    {
        $requisitions=Requisition::whereIn('status',[0,1])->latest()->paginate(15);
        return view('stock.requisition.pending_requisition',compact('requisitions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function accept_product($id)
    {
        $data=Requisition::findOrFail(encryptor('decrypt',$id));
        $warehouses=Warehouse::select('id','name','contact','company_id')->where('company_id',$data->company_id)->orderBy('name');
        $boardno=WarehouseBoard::whereIn('warehouse_id',$warehouses->pluck('id'))->orderBy('board_no')->get();
        $warehouses=$warehouses->get();
        return view('stock.requisition.accept_product',compact('data','warehouses','boardno'));
    }

    /**
     * Check stock before accept from requisition
     */
    public function accept_product_check(Request $request){
        $error_no=$success_no=0;
        $error=$success='';

        $board_no=$request->board_no;
        $indent_id=$request->indent_id;
        $location=$request->location;
        $product_id=$request->product_id;
        $del_qty_new=$request->del_qty_new;

        $instock=ProductStock::where('indent_id',$indent_id)
                                ->where('warehouse_board_id',$board_no)->where('location',$location)
                                ->where('product_id',$product_id)->whereIn('status',[0,1,2,8])->sum('qty');
        $outstock=ProductStock::where('indent_id',$indent_id)
                                ->where('warehouse_board_id',$board_no)->where('location',$location)
                                ->where('product_id',$product_id)->whereIn('status',[3,4,5,6,7,9])->sum('qty');
        if($instock){

            if($instock > $outstock){
                $balance=($instock-$outstock);
                if($balance > $del_qty_new){
                    $success_no=1;
                    $success="You have enough stock. Your current stock is ".$balance;
                }else{
                    $error_no=3;
                    $error="You dont have enough stock. Your current stock is ".$balance;
                }
            }else{
                $error_no=2;
                $error="You dont have enough stock. Your current stock is 0";
            }
        }else{
            $error_no=1;
            $error="You dont have any stock. Your current stock is 0";
        }

        $data=array('error_no'=>$error_no,"error"=>$error,'success_no'=>$success_no,'success'=>$success);
        print_r(json_encode($data));
    }

    /**
     * change product reveived
     */
    public function accept_product_edit(Request $request,$id)
    {
        DB::beginTransaction();
        try{
            $data=Requisition::findOrFail(encryptor('decrypt',$id));
            $data->updated_by=currentUserId();
            $data->status=$request->status;
            if($data->save()){
                if($request->req_det_id){
                    foreach($request->req_det_id as $i=>$req_det_id){
                        if(abs($request->del_qty[$i]) > 0){

                            $reqd=RequisitionDetails::findOrFail(encryptor('decrypt',$req_det_id));
                            $reqd->del_qty= ($reqd->del_qty + $request->del_qty[$i]);
                            $reqd->status=($reqd->qty - $reqd->del_qty)==0?"3":"2";
                            $reqd->last_del_date=Carbon::now();
                            
                            if($reqd->save()){
                                $stocko=new ProductOutStock;
                                $stocko->indent_id=$reqd->indent_id;
                                $stocko->product_id=$reqd->product_id;
                                $stocko->company_id=$reqd->company_id;
                                $stocko->warehouse_id=$request->warehouse_id[$i];
                                $stocko->warehouse_board_id=$request->warehouse_board_id[$i];
                                $stocko->unit_style_id=$reqd->unit_style_id;
                                $stocko->requisition_id=$reqd->requisition_id;
                                $stocko->location=$request->location[$i];
                                $stocko->qty=$request->del_qty[$i];
                                $stocko->production_date=$request->production_date;
                                $stocko->stock_date=Carbon::now();
                                $stocko->remarks=$request->remarks[$i];
                                $stocko->status=0;
                                $stocko->created_by=currentUserId();
                                if($stocko->save()){
                                    $stock=new ProductStock;
                                    $stock->indent_id=$reqd->indent_id;
                                    $stock->product_id=$reqd->product_id;
                                    $stock->company_id=$reqd->company_id;
                                    $stock->warehouse_id=$request->warehouse_id[$i];
                                    $stock->warehouse_board_id=$request->warehouse_board_id[$i];
                                    $stock->pos_id=$stocko->id;
                                    $stock->unit_style_id=$reqd->unit_style_id;
                                    $stock->location=$request->location[$i];
                                    $stock->qty=$request->del_qty[$i];
                                    $stock->production_date=$request->production_date;
                                    $stock->stock_date=Carbon::now();
                                    $stock->status=3;
                                    $stock->created_by=currentUserId();
                                    $stock->save();
                                }
                            }
                        }
                    }
                    DB::commit();
                    \LogActivity::addToLog('Update Requisition product to stock',$request->getContent(),'Requisition,RequisitionDetails,ProductOutStock,ProductStock');
                    return redirect(currentUser()."/pending_requisition")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
                }else{
                    return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            
        }catch(Exception $e){
            DB::rollback();
            //dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
    /**
     * change product reveived
     
    public function delete_product($reqid,$proid)
    {
        DB::beginTransaction();
        try{
            
                $reqd=RequisitionDetails::findOrFail(encryptor('decrypt',$proid));
                if($reqd->delete()){
                    $stocko= ProductOutStock;
                    $stocko->indent_id=$reqd->indent_id;
                    $stocko->product_id=$reqd->product_id;
                    $stocko->company_id=$reqd->company_id;
                    $stocko->warehouse_id=$request->warehouse_id[$i];
                    $stocko->warehouse_board_id=$request->warehouse_board_id[$i];
                    $stocko->unit_style_id=$reqd->unit_style_id;
                    $stocko->requisition_id=$reqd->requisition_id;
                    $stocko->location=$request->location[$i];
                    $stocko->qty=$request->del_qty[$i];
                    $stocko->production_date=$request->production_date;
                    $stocko->stock_date=Carbon::now();
                    $stocko->remarks=$request->remarks[$i];
                    $stocko->status=0;
                    $stocko->created_by=currentUserId();
                    if($stocko->save()){
                        $stock=new ProductStock;
                        $stock->indent_id=$reqd->indent_id;
                        $stock->product_id=$reqd->product_id;
                        $stock->company_id=$reqd->company_id;
                        $stock->warehouse_id=$request->warehouse_id[$i];
                        $stock->warehouse_board_id=$request->warehouse_board_id[$i];
                        $stock->pos_id=$stocko->id;
                        $stock->unit_style_id=$reqd->unit_style_id;
                        $stock->location=$request->location[$i];
                        $stock->qty=$request->del_qty[$i];
                        $stock->production_date=$request->production_date;
                        $stock->stock_date=Carbon::now();
                        $stock->status=3;
                        $stock->created_by=currentUserId();
                        if($stock->save()){
                            DB::commit();
                            \LogActivity::addToLog('Add Requisition',$request->getContent(),'Requisition,RequisitionDetails');
                            return redirect(currentUser()."/requisition")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
                        }
                    }
                }else{
                    return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }
*/
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Requisition $requisition)
    {
        //
    }
}
