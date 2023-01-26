<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\Supplier;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\Supplier\AddNewRequest;
use App\Http\Requests\Settings\Supplier\UpdateRequest;

use Toastr;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers=Supplier::paginate(10);
        return view('settings.supplier.index',compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.supplier.create');
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
            $data=new Supplier;
            $data->sup_code=$request->sup_code;
            $data->name=$request->name;
            $data->contact=$request->contact;
            $data->email=$request->email;
            $data->country=$request->country;
            $data->city=$request->city;
            $data->address=$request->address;
            $data->location=$request->location;
            $data->status=1;
            if($data->save())
                return redirect()->route(currentUser().'.supplier.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settimgs\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier=Supplier::findOrFail(encryptor('decrypt',$id));
        return view('settings.supplier.edit',compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settimgs\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $data=Supplier::findOrFail(encryptor('decrypt',$id));
            $data->sup_code=$request->sup_code;
            $data->name=$request->name;
            $data->contact=$request->contact;
            $data->email=$request->email;
            $data->country=$request->country;
            $data->city=$request->city;
            $data->address=$request->address;
            $data->location=$request->location;
            $data->status=$request->status;
            if($data->save())
                return redirect()->route(currentUser().'.supplier.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
