<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;

use App\Models\Stock\CompanyRequisition;
use App\Models\Stock\CompanyRequisitionDetails;
use App\Models\Company\Company;
use App\Models\Company\Warehouse;
use App\Models\Company\WarehouseBoard;
use App\Models\Stock\ProductStock;
use Illuminate\Http\Request;

use DB;
use Toastr;
use Carbon\Carbon;

class CompanyRequisitionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requisitions=CompanyRequisition::latest()->paginate(15);
        return view('stock.company_requisition.index',compact('requisitions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::select('id','name','contact')->orderBy('name')->get();

        return view('stock.company_requisition.create',compact('companies'));
    }
    /**
     * Search product
     */
    public function product_sc(Request $request){
        $wherenot="";
        if($request->oldpro){
            $wherenot=" and p.id not in (".rtrim($request->oldpro,',').")";
        }
        if($request->name){
            $product=DB::select("SELECT p.id,p.name,p.item_code FROM `products` as p WHERE p.item_type in (3,4) and (p.item_code like '". $request->name ."%' or p.name like '". $request->name ."%') and p.status=1 $wherenot limit 25");
           
            print_r(json_encode($product));  
        }
    }
    /**
     * get product input fields with details
     */
    public function product_sc_d(Request $request){

        if($request->item_id){
            $error_no=$success_no=0;
            $error=$success='';

            $data="";
            $product_qty_msg="";// get individual total qty by indent details
            $location=\Config::get('storedata.location');
            $indents_ids=ProductStock::where('company_id',$request->company_id)->pluck('indent_id','indent_id');
            if($indents_ids){
                foreach($indents_ids as $indent_id){
                    $instock=ProductStock::where('indent_id',$indent_id)->where('product_id',$request->item_id)->whereIn('status',[0,1,2,8]);
                    $outstock=ProductStock::where('indent_id',$indent_id)->where('product_id',$request->item_id)->whereIn('status',[3,4,5,6,7,9]);

                    $available=($instock->sum('qty') - $outstock->sum('qty'));
                            
                    if($available > 0){
                        $instockboard=$instock->pluck('warehouse_board_id');
                        
                        foreach($instockboard as $isb){
                            foreach($location as $loc=>$locn){
                                $instock=$instock->where('warehouse_board_id',$isb)->where('location',$loc);
                                $outstock=$outstock->where('warehouse_board_id',$isb)->where('location',$loc);
                                $availableb=($instock->sum('qty') - $outstock->sum('qty'));

                                if($availableb > 0){
                                    $success_no=1; // if find any stock it will show success
                                    $instock_data=$instock->latest('id')->first();
                                    $msg="";// available qty short message

                                    $data.='<tr class="productlist">';
                                    $data.='<td>'.$instock_data->product?->item_code.' - '.$instock_data->product?->name.'<input name="product_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->product_id.'" class="product_id_list"></td>';
                                    $data.='<td>'.$instock_data->indent?->indent_no.'<input name="indent_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->indent_id.'" class="product_id_list"></td>';
                                    $data.='<td>'.$instock_data->warehouse?->name.'<input name="warehouse_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->warehouse_id.'"></td>';
                                    $data.='<td>'.$instock_data->warehouseboard?->board_no.'<input name="warehouse_board_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->warehouse_board_id.'"></td>';
                                    $data.='<td>'.$instock_data->unitstyle?->name.'<input name="unit_style_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->unit_style_id.'"></td>';
                                    $data.='<td>'.$location[$instock_data->location].'<input name="location['.$instock_data->id.']" type="hidden" value="'.$instock_data->location.'"></td>';
                                    $data.='<td>'.\Carbon\Carbon::parse($instock_data->production_date)->format('M,d-Y').'</td>';
                                    $data.='<td>'.(float) $instock_data->unit_price.'</td>';
                                    
                                    $data.='<td><input name="qty['.$instock_data->id.']" type="text" class="form-control qty" onkeyup="check_qty(this)" value="">
                                    <input name="avaiableqty['.$instock_data->id.']" type="hidden" class="avaiableqty" value="'.$availableb.'">
                                    <small class="text-danger">Available:'.$availableb.'</small>
                                    </td>';
                                    
                                    
                                    $data.='<td>
                                                <input name="remarks['.$instock_data->id.']" type="text" class="form-control remarks" value="">
                                                <input name="unit_price['.$instock_data->id.']" type="hidden" class="unit_price" value="'.$instock_data->unit_price.'">
                                                <input name="stock_id['.$instock_data->id.']" type="hidden" class="stock_id" value="'.$instock_data->id.'">
                                                <input name="production_date['.$instock_data->id.']" type="hidden" class="production_date" value="'.$instock_data->production_date.'">
                                            </td>';
                                    $data.='<td class="text-danger"><i style="font-size:1.2rem" onclick="removerow(this)" class="bi bi bi-trash"></i></td>';
                                    $data.='</tr>';
                                }
                            }
                        }
                    }
                }
            }else{
                $product_qty_msg="This product is not in stock";
            }
            if($success_no==0){
                $product_qty_msg="This product is not in stock";
            }
                
            $return=array('data'=>$data,'msg'=>$product_qty_msg);
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
            $data=new CompanyRequisition;
            $data->company_id=$request->company_id;
            $data->company_id_to=$request->company_id_to;
            $data->qty=$request->qty_total;
            $data->creq_date=$request->creq_date;
            $data->slip_no=$request->slip_no;
            $data->issue_by=$request->issue_by;
            $data->received_by=$request->received_by;
            $data->delivary_by=$request->delivary_by;
            $data->remarks=$request->remarks_r;
            $data->status=0;
            $data->created_by=currentUserId();
            if($data->save()){
               
                if($request->stock_id){
                    foreach($request->stock_id as $stock_id){
                        if($request->qty[$stock_id] > 0){
                            // from
                            $reqd=new CompanyRequisitionDetails;
                            $reqd->company_requisition_id=$data->id;
                            $reqd->company_id=$request->company_id;
                            $reqd->indent_id=$request->indent_id[$stock_id];
                            $reqd->product_id=$request->product_id[$stock_id];
                            $reqd->warehouse_id=$request->warehouse_id[$stock_id];
                            $reqd->warehouse_board_id=$request->warehouse_board_id[$stock_id];
                            $reqd->unit_style_id=$request->unit_style_id[$stock_id];
                            $reqd->location=$request->location[$stock_id];
                            $reqd->qty=$request->qty[$stock_id];
                            $reqd->unit_price=$request->unit_price[$stock_id];
                            $reqd->production_date=$request->production_date[$stock_id];
                            $reqd->remarks=$request->remarks[$stock_id];
                            $reqd->created_by=currentUserId();
                            $reqd->status=1;
                            if($reqd->save()){
                                // to
                                $reqdi=new CompanyRequisitionDetails;
                                $reqdi->company_requisition_id=$data->id;
                                $reqdi->company_id=$request->company_id_to;
                                $reqdi->product_id=$request->product_id[$stock_id];
                                $reqdi->unit_style_id=$request->unit_style_id[$stock_id];
                                $reqdi->location=$request->location[$stock_id];
                                $reqdi->del_qty=0;
                                $reqdi->unit_price=$request->unit_price[$stock_id];
                                $reqdi->remarks=$request->remarks[$stock_id];
                                $reqdi->created_by=currentUserId();
                                $reqdi->status=0;
                                $reqdi->save();
                            }
                        }
                    }
        
                    DB::commit();
                    \LogActivity::addToLog('Transfer product company to '.$request->company_id_to.' from '.$request->company_id.' ',$request->getContent(),'CompanyRequisitionDetails,CompanyRequisition');
                    return redirect(currentUser()."/c_to_c_transfer")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
                }else{
                    return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock\CompanyRequisition  $companyRequisition
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data=CompanyRequisition::findOrFail(encryptor('decrypt',$id));
        $detailsData= DB::select("SELECT creq.`product_id`,products.name,
        GROUP_CONCAT((select indent_no from indents where indents.id=creq.indent_id)  SEPARATOR ', ') as `indent`,
        GROUP_CONCAT((select name from warehouses where warehouses.id=creq.`warehouse_id`)  SEPARATOR ', ') as `warehouse`,
        GROUP_CONCAT((select board_no from warehouse_boards where warehouse_boards.id=creq.`warehouse_board_id`)  SEPARATOR ', ') as `warehouse_board`,
        GROUP_CONCAT((select name from unit_styles where unit_styles.id=creq.`unit_style_id`)  SEPARATOR ', ') as `unit_style`, 
        GROUP_CONCAT(`location`  SEPARATOR ', ') as `location`,
        GROUP_CONCAT(TRIM(creq.`unit_price`)+0  SEPARATOR ', ') as `unit_price`,
        GROUP_CONCAT(`remarks`  SEPARATOR ', ') as `remarks`,
        GROUP_CONCAT(`production_date`  SEPARATOR ', ') as `production_date`,
        sum(`qty`) as qty, sum(`del_qty`) as del_qty,sum(`back_qty`) as back_qty FROM `company_requisition_details` as creq
         join products on products.id=creq.product_id WHERE creq.`company_requisition_id`='".encryptor('decrypt',$id)."' group by creq.`product_id`,products.name");
        //$detailsData=CompanyRequisitionDetails::where('company_requisition_id',encryptor('decrypt',$id))->where('company_id',$data->company_id)->get();
        return view('stock.company_requisition.show',compact('data','detailsData'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\CompanyRequisition  $companyRequisition
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data=CompanyRequisition::findOrFail(encryptor('decrypt',$id));
        $detailsDataSort= json_decode(json_encode(DB::select("SELECT creq.`product_id`, GROUP_CONCAT((select indent_no from indents where indents.id=indent_id)  SEPARATOR ', ') as `indent_id`, sum(`qty`) as qty, sum(`del_qty`) as del_qty,sum(`back_qty`) as back_qty FROM `company_requisition_details` as creq WHERE creq.`company_requisition_id`='".encryptor('decrypt',$id)."' group by creq.`product_id`;")), true);
        $detailsData=CompanyRequisitionDetails::where('company_requisition_id',encryptor('decrypt',$id))->where('company_id',$data->company_id)->get();
        return view('stock.company_requisition.edit',compact('data','detailsDataSort','detailsData'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock\CompanyRequisition  $companyRequisition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $data=CompanyRequisition::findOrFail(encryptor('decrypt',$id));
            $data->slip_no=$request->slip_no;
            $data->issue_by=$request->issue_by;
            $data->received_by=$request->received_by;
            $data->delivary_by=$request->delivary_by;
            $data->remarks=$request->remarks_r;
            $data->status=$request->status;
            $data->created_by=currentUserId();
            if($data->save()){
               
                if($request->stock_id){
                    foreach($request->stock_id as $stock_id){
                        if($request->qty[$stock_id] > 0){
                            // from
                            $reqd=new CompanyRequisitionDetails;
                            $reqd->company_requisition_id=$data->id;
                            $reqd->company_id=$data->company_id;
                            $reqd->indent_id=$request->indent_id[$stock_id];
                            $reqd->product_id=$request->product_id[$stock_id];
                            $reqd->warehouse_id=$request->warehouse_id[$stock_id];
                            $reqd->warehouse_board_id=$request->warehouse_board_id[$stock_id];
                            $reqd->unit_style_id=$request->unit_style_id[$stock_id];
                            $reqd->location=$request->location[$stock_id];
                            $reqd->qty=$request->qty[$stock_id];
                            $reqd->unit_price=$request->unit_price[$stock_id];
                            $reqd->production_date=$request->production_date[$stock_id];
                            $reqd->remarks=$request->remarks[$stock_id];
                            $reqd->created_by=currentUserId();
                            $reqd->status=1;
                            if($reqd->save()){
                                // to
                                $reqdi=new CompanyRequisitionDetails;
                                $reqdi->company_requisition_id=$data->id;
                                $reqdi->company_id=$data->company_id_to;
                                $reqdi->product_id=$request->product_id[$stock_id];
                                $reqdi->unit_style_id=$request->unit_style_id[$stock_id];
                                $reqdi->location=$request->location[$stock_id];
                                $reqdi->del_qty=0;
                                $reqdi->unit_price=$request->unit_price[$stock_id];
                                $reqdi->remarks=$request->remarks[$stock_id];
                                $reqdi->created_by=currentUserId();
                                $reqdi->status=0;
                                $reqdi->save();
                            }
                        }
                    }
        
                    DB::commit();
                    \LogActivity::addToLog('Transfer product updated company to '.$request->company_id_to.' from '.$request->company_id.'. New product added. ',$request->getContent(),'CompanyRequisitionDetails,CompanyRequisition');
                    return redirect(currentUser()."/c_to_c_transfer")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
                }else{
                    \LogActivity::addToLog('Transfer product updated company to '.$request->company_id_to.' from '.$request->company_id.'. No new product added.',$request->getContent(),'CompanyRequisitionDetails,CompanyRequisition');
                    DB::commit();
                    return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }catch(Exception $e){
            DB::rollback();
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock\CompanyRequisition  $companyRequisition
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyRequisition $companyRequisition)
    {
        //
    }

    /**
     * Display a listing of the requisitioned.
     *
     * @return \Illuminate\Http\Response
     */
    public function pending_requisition()
    {
        $requisitions=CompanyRequisition::latest()->paginate(15);
        return view('stock.company_requisition.pending_requisition',compact('requisitions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\Requisition  $requisition
     * @return \Illuminate\Http\Response
     */
    public function accept_product($id)
    {
        $data=CompanyRequisition::findOrFail(encryptor('decrypt',$id));
        $details=CompanyRequisitionDetails::where('company_requisition_id',$data->id)->where('company_id',$data->company_id_to)->get();
        $warehouses=Warehouse::select('id','name','contact','company_id')->where('company_id',$data->company_id_to)->orderBy('name');
        $boardno=WarehouseBoard::whereIn('warehouse_id',$warehouses->pluck('id'))->orderBy('board_no')->get();
        $warehouses=$warehouses->get();
        return view('stock.company_requisition.accept_product',compact('data','warehouses','boardno','details'));
    }
}
