<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Warehouse;
use App\Models\Company\Company;
use App\Models\Company\WarehouseBoard;
use Illuminate\Http\Request;
use App\Http\Requests\Company\WarehouseBoard\AddNewRequest;
use App\Http\Requests\Company\WarehouseBoard\UpdateRequest;

use Toastr;

class WarehouseBoardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouseboards=WarehouseBoard::latest()->paginate(15);
        return view('company.warehouseboard.index',compact('warehouseboards'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::select('id','name','contact')->get();
        $warehouses=Warehouse::select('id','name','contact','company_id')->get();
        return view('company.warehouseboard.create',compact('companies','warehouses'));
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
            $warehouseboard=new WarehouseBoard;
            $warehouseboard->warehouse_id=$request->warehouse_id;
            $warehouseboard->board_type=$request->board_type;
            $warehouseboard->board_no=$request->board_no;
            $warehouseboard->capacity=$request->capacity;
            $warehouseboard->location=$request->location;
            $warehouseboard->created_by=currentUserId();
            $warehouseboard->status=1;
            if($warehouseboard->save())
                return redirect()->route(currentUser().'.warehouseboard.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company\WarehouseBoard  $warehouseBoard
     * @return \Illuminate\Http\Response
     */
    public function show(WarehouseBoard $warehouseBoard)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company\WarehouseBoard  $warehouseBoard
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies=Company::select('id','name','contact')->get();
        $warehouses=Warehouse::select('id','name','contact','company_id')->get();
        $warehouseboard=WarehouseBoard::findOrFail(encryptor('decrypt',$id));
        return view('company.warehouseboard.edit',compact('companies','warehouses','warehouseboard'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company\WarehouseBoard  $warehouseBoard
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $warehouseboard=WarehouseBoard::findOrFail(encryptor('decrypt',$id));
            $warehouseboard->warehouse_id=$request->warehouse_id;
            $warehouseboard->board_type=$request->board_type;
            $warehouseboard->board_no=$request->board_no;
            $warehouseboard->capacity=$request->capacity;
            $warehouseboard->location=$request->location;
            $warehouseboard->updated_by=currentUserId();
            $warehouseboard->status=$request->status;
            if($warehouseboard->save())
                return redirect()->route(currentUser().'.warehouseboard.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company\WarehouseBoard  $warehouseBoard
     * @return \Illuminate\Http\Response
     */
    public function destroy(WarehouseBoard $warehouseBoard)
    {
        //
    }
}
