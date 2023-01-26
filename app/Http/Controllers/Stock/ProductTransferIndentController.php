<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;

use App\Models\Stock\ProductTransferIndent;
use App\Models\Stock\ProductTransferIndentDetails;
use App\Models\Stock\ProductInStock;
use App\Models\Stock\ProductOutStock;
use App\Models\Stock\ProductStock;
use App\Models\Product\Indent;
use App\Models\Product\IndentDetails;
use App\Models\Company\Company;
use App\Models\Company\Warehouse;
use App\Models\Company\WarehouseBoard;
use Illuminate\Http\Request;

use DB;
use Toastr;
use Carbon\Carbon;

class ProductTransferIndentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $ptransfer_indents=ProductTransferIndent::orderBy('id','DESC')->latest();
        
        if($request->indent_no)
            $ptransfer_indents=$ptransfer_indents->where('indent_no','like','%'.$request->indent_no.'%');
        if($request->indent_to_id)
            $ptransfer_indents=$ptransfer_indents->where('indent_to_id','like','%'.$request->indent_to_id.'%');

        $ptransfer_indents=$ptransfer_indents->paginate(15);

        return view('stock.ptransind.index',compact('ptransfer_indents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $indents=Indent::select('id','indent_no','qty','company_id')->where('status',1)->orderBy('indent_no','ASC')->get();
        return view('stock.ptransind.create',compact('companies','indents'));
    }

    /**
     * Check stock before accept from requisition
     */
    public function get_product(Request $request){
        $error_no=$success_no=0;
        $error=$success='';

        $ind_qty=$request->ind_qty;
        $indent_id=$request->indent_id;
        $products=IndentDetails::where('indent_id',$indent_id)->get();
        $data="";
        $product_qty=0;// get individual total qty by indent details
        $location=\Config::get('storedata.location');
        if($products){
            foreach($products as $ip){
                $instock=ProductStock::where('indent_id',$indent_id)->where('product_id',$ip->product_id)->whereIn('status',[0,1,2,8]);
                $outstock=ProductStock::where('indent_id',$indent_id)->where('product_id',$ip->product_id)->whereIn('status',[3,4,5,6,7,9]);

                $available=($instock->sum('qty') - $outstock->sum('qty'));
                
                if($available > 0){
                    $instockboard=$instock->pluck('warehouse_board_id');
                    
                    foreach($instockboard as $isb){
                        foreach($location as $loc=>$locn){
                            $instock=$instock->where('warehouse_board_id',$isb)->where('location',$loc);
                            $outstock=$outstock->where('warehouse_board_id',$isb)->where('location',$loc);
                            $availableb=($instock->sum('qty') - $outstock->sum('qty'));

                            if($availableb > 0){
                                $instock_data=$instock->first();
                                //foreach($instock->get() as $instock_data){
                                    $msg="";// available qty short message

                                    $data.='<tr class="productlist">';
                                    $data.='<td>'.$instock_data->product?->item_code.' - '.$instock_data->product?->name.'<input name="product_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->product_id.'" class="product_id_list"></td>';
                                    $data.='<td>'.$instock_data->warehouse?->name.'<input name="warehouse_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->warehouse_id.'"></td>';
                                    $data.='<td>'.$instock_data->warehouseboard?->board_no.'<input name="warehouse_board_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->warehouse_board_id.'"></td>';
                                    $data.='<td>'.$instock_data->unitstyle?->name.'<input name="unit_style_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->unit_style_id.'"></td>';
                                    $data.='<td>'.$location[$instock_data->location].'<input name="location['.$instock_data->id.']" type="hidden" value="'.$instock_data->location.'"></td>';
                                    $data.='<td>'.\Carbon\Carbon::parse($instock_data->production_date)->format('M,d-Y').'</td>';
                                    $data.='<td>'.(float) $instock_data->unit_price.'</td>';
                                    if($ind_qty > 0){
                                        $product_qty= ($ind_qty * $ip->qty);
                                        if($product_qty > $availableb){
                                            $msg="Short: ".($product_qty - $availableb);
                                            $product_qty=$availableb;
                                        }
                                        $data.='<td><input name="qty['.$instock_data->id.']" type="text" class="form-control qty" value="'.$product_qty.'">
                                                <input name="avaiableqty['.$instock_data->id.']" type="hidden" class="avaiableqty" value="'.$availableb.'">
                                                <small class="text-danger">Available:'.$availableb.'</small>
                                                <small class="text-danger">'.$msg.'</small>
                                                </td>';
                                    }else{
                                        $data.='<td><input name="qty['.$instock_data->id.']" type="text" class="form-control qty" value="">
                                        <input name="avaiableqty['.$instock_data->id.']" type="hidden" class="avaiableqty" value="'.$availableb.'">
                                        <small class="text-danger">Available:'.$availableb.'</small>
                                        </td>';
                                    }
                                    
                                    $data.='<td><input name="remarks['.$instock_data->id.']" type="text" class="form-control remarks" value=""></td>';
                                    $data.='<td>
                                                <input name="stock_id[]" type="checkbox" value="'.$instock_data->id.'" class="stock_id">
                                                <input name="unit_price['.$instock_data->id.']" type="hidden" class="unit_price" value="'.$instock_data->unit_price.'">
                                            </td>';
                                    $data.='</tr>';

                                //}
                            }
                        }
                    }
                }
            }
        }

        $return=array('data'=>$data);
        print_r(json_encode($return));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        DB::beginTransaction();
        try{
            $data=new ProductTransferIndent;
            $data->indent_id=$request->indent_id;
            $data->indent_to_id=$request->indent_to_id;
            $data->company_id=$request->company_id;
            $data->qty=$request->ind_qty;
            $data->stock_date=$request->stock_date;
            $data->production_date=$request->production_date;
            $data->created_by=currentUserId();
            if($data->save()){
                if($request->stock_id){
                    foreach($request->stock_id as $stock_id){
                        // from
                        $reqd=new ProductTransferIndentDetails;
                        $reqd->transfer_id=$data->id;
                        $reqd->indent_id=$request->indent_id;
                        $reqd->product_id=$request->product_id[$stock_id];
                        $reqd->company_id=$request->company_id;
                        $reqd->warehouse_id=$request->warehouse_id[$stock_id];
                        $reqd->warehouse_board_id=$request->warehouse_board_id[$stock_id];
                        $reqd->unit_style_id=$request->unit_style_id[$stock_id];
                        $reqd->location=$request->location[$stock_id];
                        $reqd->qty='-'.$request->qty[$stock_id];
                        $reqd->unit_price=$request->unit_price[$stock_id];
                        $reqd->stock_date=$request->stock_date;
                        $reqd->remarks=$request->remarks[$stock_id];
                        $reqd->created_by=currentUserId();
                        $reqd->status=0;
                        if($reqd->save()){
                            /* main stock table update (out) */
                            $stocko=new ProductStock;
                            $stocko->indent_id=$reqd->indent_id;
                            $stocko->product_id=$reqd->product_id;
                            $stocko->company_id=$reqd->company_id;
                            $stocko->warehouse_id=$reqd->warehouse_id;
                            $stocko->warehouse_board_id=$reqd->warehouse_board_id;
                            $stocko->pts_id=$reqd->id;
                            $stocko->unit_style_id=$reqd->unit_style_id;
                            $stocko->location=$reqd->location;
                            $stocko->qty=$reqd->qty;
                            $stocko->production_date=$request->production_date;
                            $stocko->stock_date=$reqd->stock_date;
                            $stocko->status=9;
                            $stocko->created_by=currentUserId();
                            $stocko->save();
                            
                            // to
                            $reqdi=new ProductTransferIndentDetails;
                            $reqdi->transfer_id=$data->id;
                            $reqdi->indent_id=$request->indent_to_id;
                            $reqdi->product_id=$request->product_id[$stock_id];
                            $reqdi->company_id=$request->company_id;
                            $reqdi->warehouse_id=$request->warehouse_id[$stock_id];
                            $reqdi->warehouse_board_id=$request->warehouse_board_id[$stock_id];
                            $reqdi->unit_style_id=$request->unit_style_id[$stock_id];
                            $reqdi->location=$request->location[$stock_id];
                            $reqdi->qty=$request->qty[$stock_id];
                            $reqdi->unit_price=$request->unit_price[$stock_id];
                            $reqdi->stock_date=$request->stock_date;
                            $reqdi->remarks=$request->remarks[$stock_id];
                            $reqdi->created_by=currentUserId();
                            $reqdi->status=1;
                            if($reqdi->save()){
                                $stock=new ProductStock;
                                $stock->indent_id=$reqdi->indent_id;
                                $stock->product_id=$reqdi->product_id;
                                $stock->company_id=$reqdi->company_id;
                                $stock->warehouse_id=$reqdi->warehouse_id;
                                $stock->warehouse_board_id=$reqdi->warehouse_board_id;
                                $stock->pts_id=$reqdi->id;
                                $stock->unit_style_id=$reqdi->unit_style_id;
                                $stock->location=$reqdi->location;
                                $stock->qty=$reqdi->qty;
                                $stock->production_date=$request->production_date;
                                $stock->stock_date=$reqdi->stock_date;
                                $stock->status=8;
                                $stock->created_by=currentUserId();
                                $stock->save();
                            }
                        }
                    }
        
                    DB::commit();
                    \LogActivity::addToLog('Transfer product indent to '.$request->indent_id_to.' from '.$request->indent_id.' ',$request->getContent(),'ProductTransferIndent');
                    return redirect(currentUser()."/stocktransferind")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Stock\ProductTransferIndent  $productTransferIndent
     * @return \Illuminate\Http\Response
     */
    public function show($id){
        $data=ProductTransferIndent::findOrFail(encryptor('decrypt',$id));
        \DB::statement("SET SQL_MODE=''");
        $products=ProductTransferIndentDetails::where('indent_id',$data->indent_to_id)->groupBy('product_id')->get();
        return view('stock.ptransind.show',compact('data','products'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\ProductTransferIndent  $productTransferIndent
     * @return \Illuminate\Http\Response
     */
    public function edit($id){
        $data=ProductTransferIndent::findOrFail(encryptor('decrypt',$id));
        $details=$this->get_back_product($data->indent_id,$data->indent_to_id);
        return view('stock.ptransind.edit',compact('data','details'));
    }
    /**
     * Check stock before accept from product back to indent
     */
    public function get_back_product($idtfrom,$indto){
        $error_no=$success_no=0;
        $error=$success='';

        $back_qty=0;
        $indent_id=$indto;
        $products=ProductTransferIndentDetails::where('indent_id',$indto)->pluck('product_id','product_id');
        $data="";
        $product_qty=0;// get individual total qty by indent details
        $location=\Config::get('storedata.location');
        if($products){
            foreach($products as $ip){
                $back_qty=ProductTransferIndentDetails::where('indent_id',$indto)->where('product_id',$ip)->sum('qty'); // check qty remain for back

                $instock=ProductStock::where('indent_id',$indent_id)->where('product_id',$ip)->whereIn('status',[0,1,2,8]);
                $outstock=ProductStock::where('indent_id',$indent_id)->where('product_id',$ip)->whereIn('status',[3,4,5,6,7,9]);

                $available=($instock->sum('qty') - $outstock->sum('qty'));
                
                if($available > 0){
                    $instockboard=$instock->pluck('warehouse_board_id');
                    
                    foreach($instockboard as $isb){
                        foreach($location as $loc=>$locn){
                            $instock=$instock->where('warehouse_board_id',$isb)->where('location',$loc);
                            $outstock=$outstock->where('warehouse_board_id',$isb)->where('location',$loc);
                            $availableb=($instock->sum('qty') - $outstock->sum('qty'));

                            if($availableb > 0){
                                $instock_data=$instock->first();
                                    $msg="";// available qty short message

                                    $data.='<tr class="productlist">';
                                    $data.='<td>'.$instock_data->product?->name.'<input name="product_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->product_id.'" class="product_id_list"></td>';
                                    $data.='<td>'.$instock_data->warehouse?->name.'<input name="warehouse_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->warehouse_id.'"></td>';
                                    $data.='<td>'.$instock_data->warehouseboard?->board_no.'<input name="warehouse_board_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->warehouse_board_id.'"></td>';
                                    $data.='<td>'.$instock_data->unitstyle?->name.'<input name="unit_style_id['.$instock_data->id.']" type="hidden" value="'.$instock_data->unit_style_id.'"></td>';
                                    $data.='<td>'.$location[$instock_data->location].'<input name="location['.$instock_data->id.']" type="hidden" value="'.$instock_data->location.'"></td>';
                                    $data.='<td>'.\Carbon\Carbon::parse($instock_data->production_date)->format('M,d-Y').'</td>';
                                    $data.='<td>'.(float) $instock_data->unit_price.'</td>';
                                    if($back_qty > 0){
                                        $product_qty= $back_qty;
                                        if($product_qty > $availableb){
                                            $msg="Short: ".($product_qty - $availableb);
                                            $product_qty=$availableb;
                                        }
                                        $data.='<td><input name="qty['.$instock_data->id.']" type="text" class="form-control qty" value="'.(float) $product_qty.'">
                                                <input name="avaiableqty['.$instock_data->id.']" type="hidden" class="avaiableqty" value="'.$availableb.'">
                                                <small class="text-danger">Available:'.$availableb.'</small>
                                                <small class="text-danger">'.$msg.'</small>
                                                </td>';
                                    }else{
                                        $data.='<td><input name="qty['.$instock_data->id.']" type="text" class="form-control qty" value="">
                                        <input name="avaiableqty['.$instock_data->id.']" type="hidden" class="avaiableqty" value="'.$availableb.'">
                                        <small class="text-danger">Available:'.$availableb.'</small>
                                        </td>';
                                    }
                                    
                                    $data.='<td><input name="remarks['.$instock_data->id.']" type="text" class="form-control remarks" value=""></td>';
                                    $data.='<td>
                                                <input name="stock_id[]" type="checkbox" value="'.$instock_data->id.'" class="stock_id">
                                                <input name="unit_price['.$instock_data->id.']" type="hidden" class="unit_price" value="'.$instock_data->unit_price.'">
                                            </td>';
                                    $data.='</tr>';

                                
                            }
                        }
                    }
                }
            }
        }

        $return=array('data'=>$data);
        return $return;
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock\ProductTransferIndent  $productTransferIndent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{
            $data=ProductTransferIndent::findOrFail(encryptor('decrypt',$id));
            $data->updated_by=currentUserId();
            if($data->save()){
                if($request->stock_id){
                    foreach($request->stock_id as $stock_id){
                        // new to old from
                        $reqd=new ProductTransferIndentDetails;
                        $reqd->transfer_id=$data->id;
                        $reqd->indent_id=$data->indent_to_id;
                        $reqd->product_id=$request->product_id[$stock_id];
                        $reqd->company_id=$data->company_id;
                        $reqd->warehouse_id=$request->warehouse_id[$stock_id];
                        $reqd->warehouse_board_id=$request->warehouse_board_id[$stock_id];
                        $reqd->unit_style_id=$request->unit_style_id[$stock_id];
                        $reqd->location=$request->location[$stock_id];
                        $reqd->qty='-'.$request->qty[$stock_id];
                        $reqd->unit_price=$request->unit_price[$stock_id];
                        $reqd->stock_date=$request->stock_date;
                        $reqd->remarks=$request->remarks[$stock_id];
                        $reqd->created_by=currentUserId();
                        $reqd->status=0;
                        if($reqd->save()){
                            /* main stock table update (out) */
                            $stocko=new ProductStock;
                            $stocko->indent_id=$reqd->indent_id;
                            $stocko->product_id=$reqd->product_id;
                            $stocko->company_id=$reqd->company_id;
                            $stocko->warehouse_id=$reqd->warehouse_id;
                            $stocko->warehouse_board_id=$reqd->warehouse_board_id;
                            $stocko->pts_id=$reqd->id;
                            $stocko->unit_style_id=$reqd->unit_style_id;
                            $stocko->location=$reqd->location;
                            $stocko->qty=$reqd->qty;
                            $stocko->production_date=$request->production_date;
                            $stocko->stock_date=$reqd->stock_date;
                            $stocko->status=9;
                            $stocko->created_by=currentUserId();
                            $stocko->save();

                            $reqdi=new ProductTransferIndentDetails;
                            $reqdi->transfer_id=$data->id;
                            $reqdi->indent_id=$data->indent_id;
                            $reqdi->product_id=$request->product_id[$stock_id];
                            $reqdi->company_id=$data->company_id;
                            $reqdi->warehouse_id=$request->warehouse_id[$stock_id];
                            $reqdi->warehouse_board_id=$request->warehouse_board_id[$stock_id];
                            $reqdi->unit_style_id=$request->unit_style_id[$stock_id];
                            $reqdi->location=$request->location[$stock_id];
                            $reqdi->qty=$request->qty[$stock_id];
                            $reqdi->unit_price=$request->unit_price[$stock_id];
                            $reqdi->stock_date=$request->stock_date;
                            $reqdi->remarks=$request->remarks[$stock_id];
                            $reqdi->created_by=currentUserId();
                            $reqdi->status=1;
                            if($reqdi->save()){
                                $stock=new ProductStock;
                                $stock->indent_id=$reqdi->indent_id;
                                $stock->product_id=$reqdi->product_id;
                                $stock->company_id=$reqdi->company_id;
                                $stock->warehouse_id=$reqdi->warehouse_id;
                                $stock->warehouse_board_id=$reqdi->warehouse_board_id;
                                $stock->pts_id=$reqdi->id;
                                $stock->unit_style_id=$reqdi->unit_style_id;
                                $stock->location=$reqdi->location;
                                $stock->qty=$reqdi->qty;
                                $stock->production_date=$request->production_date;
                                $stock->stock_date=$reqdi->stock_date;
                                $stock->status=8;
                                $stock->created_by=currentUserId();
                                $stock->save();
                            }
                        }
                    }
        
                    DB::commit();
                    \LogActivity::addToLog('Transfer back product indent to '.$data->indent_id.' from '.$data->indent_id_to.' ',$request->getContent(),'ProductTransferIndent');
                    return redirect(currentUser()."/stocktransferind")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock\ProductTransferIndent  $productTransferIndent
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductTransferIndent $productTransferIndent)
    {
        //
    }
}
