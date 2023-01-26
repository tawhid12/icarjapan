<?php

namespace App\Http\Controllers\Stock;
use App\Http\Controllers\Controller;

use App\Models\Stock\ProductOutStock;
use App\Models\Stock\ProductStock;
use App\Models\Product\Indent;
use App\Models\Settings\UnitStyle;
use App\Models\Settings\Supplier;
use App\Models\Company\Company;
use App\Models\Company\Warehouse;
use App\Models\Company\WarehouseBoard;
use Illuminate\Http\Request;
use App\Http\Requests\Stock\StockOut\AddNewRequest;
use App\Http\Requests\Stock\StockOut\UpdateRequest;

use DB;
use Toastr;

class ProductOutStockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pstockout=ProductOutStock::orderBy('id','DESC')->paginate(15);
        return view('stock.outstock.index',compact('pstockout'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        $warehouses=Warehouse::select('id','name','contact','company_id')->orderBy('name')->get();
        $indents=Indent::select('id','indent_no','qty','company_id')->where('status',1)->orderBy('indent_no','ASC')->get();
        $suppliers=Supplier::orderBy('name')->get();
        return view('stock.outstock.create',compact('suppliers','companies','indents','warehouses'));
    }
     /**
     * get data as indent no.
     *
     * @return \Illuminate\Http\Response
     */
    public function product_sc_d(Request $request){
        if($request->indent_id){
            $products=DB::select("SELECT products.id,products.item_code,products.name,indent_details.qty as perqty,product_stocks.qty FROM `products` join indent_details on indent_details.product_id=products.id left join product_stocks on product_stocks.product_id=products.id where indent_details.indent_id='".$request->indent_id."'");
        
            foreach($products as $product){
            $data='<tr class="productlist">';
            $data.='<td>'.$product[0]->name.'<input name="product_id[]" type="hidden" value="'.$product[0]->id.'" class="product_id_list"></td>';
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
            }
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stock\ProductOutStock  $productOutStock
     * @return \Illuminate\Http\Response
     */
    public function show(ProductOutStock $productOutStock)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stock\ProductOutStock  $productOutStock
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductOutStock $productOutStock)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stock\ProductOutStock  $productOutStock
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductOutStock $productOutStock)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stock\ProductOutStock  $productOutStock
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductOutStock $productOutStock)
    {
        //
    }
}
