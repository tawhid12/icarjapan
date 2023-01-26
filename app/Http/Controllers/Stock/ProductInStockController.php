<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;

use App\Models\Stock\ProductInStock;
use App\Models\Stock\ProductStock;
use App\Models\Product\Indent;
use App\Models\Settings\UnitStyle;
use App\Models\Settings\Supplier;
use App\Models\Company\Company;
use App\Models\Company\Warehouse;
use App\Models\Company\WarehouseBoard;

use Illuminate\Http\Request;
use App\Http\Requests\Stock\StockIn\AddNewRequest;
use App\Http\Requests\Stock\StockIn\UpdateRequest;

use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ImportFromExce;

use DB;
use Toastr;

class ProductInStockController extends Controller{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $pstockin=ProductInStock::orderBy('id','DESC')->paginate(15);
        return view('stock.instock.index',compact('pstockin'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $warehouses=Warehouse::select('id','name','contact','company_id')->orderBy('name')->get();
        $indents=Indent::select('id','indent_no','qty','company_id')->where('status',1)->orderBy('indent_no','ASC')->get();
        $suppliers=Supplier::orderBy('name')->get();
        return view('stock.instock.create',compact('suppliers','companies','indents','warehouses'));
    }

    /**
     * Show the form for creating a new resource from excel.
     *
     * @return \Illuminate\Http\Response
     */
    public function createexcel(){
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $warehouses=Warehouse::select('id','name','contact','company_id')->orderBy('name')->get();
        $indents=Indent::select('id','indent_no','qty','company_id')->where('status',1)->orderBy('indent_no','ASC')->get();
        $suppliers=Supplier::orderBy('name')->get();
        return view('stock.instock.createexcel',compact('suppliers','companies','indents','warehouses'));
    }
    /**
     * Check stock before upload if duplicate or not
     */
    public function check_invoice(Request $request){
        $ind=$request->ind;
        $inv=$request->inv;
        $sup=$request->sup;
        $product=ProductInStock::where('indent_id',$ind)->where('purchase_order',$inv)->where('supplier_id',$sup)->exists();
        
        print_r(json_encode($product));
    }
    /**
     * Search product
     */
    public function product_sc(Request $request){
        $ind=$request->indent_id;
        if($request->name){
            $product=DB::select("SELECT p.id,p.name,p.item_code FROM `products` as p join indent_details on indent_details.product_id=p.id WHERE p.item_type in (3,4) and p.item_code like '". $request->name ."%' and p.status=1");
            if(empty($product))
                $product=DB::select("SELECT DISTINCT p.id,p.name,p.item_code FROM `products` as p join indent_details on indent_details.semi_finish_product_id=p.id WHERE p.item_type = 2 and p.item_code like '". $request->name ."%' and p.status=1");
            
            print_r(json_encode($product));  
        }
    }
    /**
     * get product input fields with details
     */
    public function product_sc_d(Request $request){
        if($request->item_id){
            $product=DB::select("SELECT * FROM `products` WHERE id=".$request->item_id."");
            $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
            $warehouse_board=DB::select("SELECT id,board_no,capacity FROM `warehouse_boards` where warehouse_id='".$request->warehouse_id."'");
            
            $data='<tr class="productlist">';
            $data.='<td>'.$product[0]->item_code.' - '.$product[0]->name.'<input name="product_id[]" type="hidden" value="'.$product[0]->id.'" class="product_id_list"></td>';
            $data.='<td>
                        <select class="form-control form-select choicessf'.$product[0]->id.' warehouse_board_id" name="warehouse_board_id[]">';
                            if($warehouse_board){
                                foreach($warehouse_board as $us){
                                    $data.='<option value="'.$us->id.'">'.$us->board_no.' ('.$us->capacity.')</option>';
                                }
                            }
            $data.='</select></td>';
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
            $data.='<td><input name="unit_price[]" type="text" class="form-control price" value="0"></td>';
            $data.='<td><input name="production_date[]" type="date" class="form-control production_date" value=""></td>';
            $data.='<td><input name="remarks[]" type="text" class="form-control remarks" value=""></td>';
            $data.='<td class="text-danger"><i style="font-size:1.2rem" onclick="removerow(this)" class="bi bi bi-trash"></i></td>';
            $data.='</tr>';
            $return=array('data'=>$data,'choice'=>$product[0]->id);
            print_r(json_encode($return));
        }
    }
    /**
     * get uploaded excel file and get ready the data
     */
    public function upexcel(Request $request){
        $total_data=0;
        $data="";
        $unitstyles=DB::select("SELECT id,name FROM `unit_styles` where status=1");
        $warehouse_board=DB::select("SELECT id,board_no,capacity FROM `warehouse_boards` where warehouse_id='".$request->warehouse_id."'");
        $exceldata = Excel::toArray(new ImportFromExce(), $request->file);
        if(count($exceldata)>0){
            $total_data=count($exceldata);
            foreach($exceldata[0] as $d){
                $product=DB::select("SELECT id,item_code,name,item_type,unit_style_id FROM `products` WHERE item_code='".$d[0]."'");
                
                if($product){
                    $proddate=isset($d[7])?\Carbon\Carbon::instance(\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($d[7]))->format('Y-m-d'):0;
                    $unitprice=trim($d[4])?trim($d[4]):0;
                    $data.='<tr class="productlist">';
                    $data.='<td>'.$product[0]->item_code.'- '.$product[0]->name.'<input name="product_id[]" type="hidden" value="'.$product[0]->id.'" class="product_id_list"></td>';
                    $data.='<td>
                                <select class="form-control form-select choicessf'.$product[0]->id.' warehouse_board_id" name="warehouse_board_id[]">';
                                    if($warehouse_board){
                                        foreach($warehouse_board as $us){
                                            $selected="";
                                            if($us->board_no==$d[6])
                                                    $selected="selected";
                                            $data.='<option '.$selected.' value="'.$us->id.'">'.$us->board_no.' ('.$us->capacity.')</option>';
                                        }
                                    }
                    $data.='</select></td>';
                    $data.='<td>
                                <select class="form-control form-select choices'.$product[0]->id.' unit_style_id" name="unit_style_id[]">';
                                    if($unitstyles){
                                        foreach($unitstyles as $us){
                                            $selected="";
                                            if($us->name==trim($d[2]))
                                                    $selected="selected";
                                            $data.='<option '.$selected.' value="'.$us->id.'">'.$us->name.'</option>';
                                        }
                                    }
                    $data.='</select></td>';
                    $data.='<td><input name="qty[]" type="text" class="form-control qty" value="'.trim($d[3]).'"></td>';
                    $data.='<td><input name="unit_price[]" type="text" class="form-control price" value="'.$unitprice.'"></td>';
                    $data.='<td><input name="production_date[]" type="text" class="form-control production_date" value="'.$proddate.'"></td>';
                    $data.='<td><input name="remarks[]" type="text" class="form-control remarks" value="'.trim($d[5]).'"></td>';
                    $data.='<td class="text-danger"><i style="font-size:1.2rem" onclick="removerow(this)" class="bi bi bi-trash"></i></td>';
                    $data.='</tr>';
                }
            }
        }else{
            $msg="Your excel file dose not contain valid data";
        }
        $return=array('data'=>$data,'choice'=>$product[0]->id);
        print_r(json_encode($return));
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
            if($request->product_id){
                foreach($request->product_id as $i=>$product_id){
                    $psd=new ProductInStock;
                    $psd->indent_id=$request->indent_id;
                    $psd->product_id=$product_id;
                    $psd->company_id=$request->company_id;
                    $psd->warehouse_id=$request->warehouse_id;
                    $psd->supplier_id=$request->supplier_id;
                    $psd->location=$request->location;
                    $psd->purchase_order=$request->purchase_order;
                    $psd->slip_no=$request->slip_no;
                    $psd->warehouse_board_id=$request->warehouse_board_id[$i];
                    $psd->unit_style_id=$request->unit_style_id[$i];
                    $psd->qty=$request->qty[$i];
                    $psd->unit_price=$request->unit_price[$i];
                    $psd->production_date=$request->production_date[$i];
                    $psd->stock_date=$request->stock_date;
                    $psd->remarks=$request->remarks[$i];
                    $psd->created_by=currentUserId();
                    $psd->status=0;
                    if($psd->save()){
                        $oldstock=ProductStock::where('company_id',$psd->company_id)
                                    ->where('warehouse_id',$psd->warehouse_id)
                                    ->where('warehouse_board_id',$psd->warehouse_board_id)
                                    ->where('location',$psd->location)
                                    ->where('indent_id',$psd->indent_id)
                                    ->where('product_id',$psd->product_id)
                                    ->first();
                        if($oldstock){ // update if old found
                            $stock=$oldstock;
                            $stock->pis_id=$stock->pis_id .','.$psd->id;
                            $stock->purchase_order=$stock->purchase_order .','.$psd->purchase_order;
                            $stock->qty=($stock->qty + $psd->qty);
                            $stock->unit_price=$psd->unit_price;
                            $stock->production_date=$psd->production_date;
                            $stock->stock_date=$request->stock_date;
                            $stock->save();
                        }else{ // add if old not found
                            $stock=new ProductStock;
                            $stock->indent_id=$request->indent_id;
                            $stock->product_id=$product_id;
                            $stock->company_id=$request->company_id;
                            $stock->warehouse_id=$request->warehouse_id;
                            $stock->warehouse_board_id=$request->warehouse_board_id[$i];
                            $stock->pis_id=$psd->id;
                            $stock->unit_style_id=$request->unit_style_id[$i];
                            $stock->location=$request->location;
                            $stock->purchase_order=$request->purchase_order;
                            $stock->stock_date=$request->stock_date;
                            $stock->qty=$request->qty[$i];
                            $stock->unit_price=$request->unit_price[$i];
                            $stock->production_date=$request->production_date[$i];
                            $stock->created_by=currentUserId();
                            $stock->status=0;
                            $stock->save();
                        }
                    }
                }
                DB::commit();
                return redirect(currentUser()."/stockin")->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            }else{
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            return redirect()->back()->withInput()->with(Toastr::error('No product selected!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock\ProductInStock  $productInStock
     * @return \Illuminate\Http\Response
     */
    public function show(ProductInStock $productInStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\ProductInStock  $productInStock
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pis=ProductInStock::findOrFail(encryptor('decrypt',$id));
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $warehouses=Warehouse::select('id','name','contact','company_id')->orderBy('name')->get();
        $warehouseboards=WarehouseBoard::select('id','board_no','capacity','warehouse_id')->orderBy('board_no')->get();
        $indents=Indent::select('id','indent_no','qty','company_id')->where('status',1)->orderBy('indent_no','ASC')->get();
        $suppliers=Supplier::orderBy('name')->get();
        $unitstyles=UnitStyle::orderBy('name','ASC')->get();
        return view('stock.instock.edit',compact('pis','suppliers','companies','indents','warehouseboards','warehouses','unitstyles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock\ProductInStock  $productInStock
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        DB::beginTransaction();
        try{
            $psd=ProductInStock::findOrFail(encryptor('decrypt',$id));
            $psd->indent_id=$request->indent_id;
            $psd->company_id=$request->company_id;
            $psd->warehouse_id=$request->warehouse_id;
            $psd->warehouse_board_id=$request->warehouse_board_id;
            $psd->supplier_id=$request->supplier_id;
            $psd->location=$request->location;
            $psd->purchase_order=$request->purchase_order;
            $psd->slip_no=$request->slip_no;
            $psd->unit_style_id=$request->unit_style_id;
            $psd->qty=$request->qty;
            $psd->unit_price=$request->unit_price;
            $psd->production_date=$request->production_date;
            if($psd->save()){
echo "ok";
            }
            DB::commit();
        }catch(Exception $e){
            DB::rollback();
            dd($e);
            return redirect()->back()->withInput()->with($this->resMessageHtml(false,'error','Please try again'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock\ProductInStock  $productInStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductInStock $productInStock)
    {
        //
    }
}
