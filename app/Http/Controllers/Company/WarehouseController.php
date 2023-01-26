<?php
namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Company\Warehouse;
use App\Models\Company\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Company\Warehouse\AddNewRequest;
use App\Http\Requests\Company\Warehouse\UpdateRequest;

use Toastr;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $warehouses=Warehouse::latest()->paginate(15);
        return view('company.warehouse.index',compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies=Company::select('id','name','contact')->orderBy('name')->get();
        return view('company.warehouse.create',compact('companies'));
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
            $warehouse=new Warehouse;
            $warehouse->company_id=$request->company_id;
            $warehouse->name=$request->name;
            $warehouse->contact=$request->contact;
            $warehouse->email=$request->email;
            $warehouse->address=$request->address;
            $warehouse->location=$request->location;
            $warehouse->created_by=currentUserId();
            $warehouse->status=1;
            if($warehouse->save())
                return redirect()->route(currentUser().'.warehouse.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Company\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function show(Warehouse $warehouse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $companies=Company::select('id','name','contact')->get();
        $warehouse=Warehouse::findOrFail(encryptor('decrypt',$id));
        return view('company.warehouse.edit',compact('warehouse','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $warehouse=Warehouse::findOrFail(encryptor('decrypt',$id));
            $warehouse->company_id=$request->company_id;
            $warehouse->name=$request->name;
            $warehouse->contact=$request->contact;
            $warehouse->email=$request->email;
            $warehouse->address=$request->address;
            $warehouse->location=$request->location;
            $warehouse->updated_by=currentUserId();
            $warehouse->status=$request->status;
            if($warehouse->save())
                return redirect()->route(currentUser().'.warehouse.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company\Warehouse  $warehouse
     * @return \Illuminate\Http\Response
     */
    public function destroy(Warehouse $warehouse)
    {
        //
    }
}
