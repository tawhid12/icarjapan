<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\InventoryLocation;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\InventoryLocation\AddNewRequest;
use App\Http\Requests\Settings\InventoryLocation\UpdateRequest;

use Toastr;

class InventoryLocationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $inv_locations=InventoryLocation::latest()->paginate(15);
        return view('settings.invlocations.index',compact('inv_locations'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.invlocations.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $inv_loc=new InventoryLocation();
            $inv_loc->name=$request->name;
            if($inv_loc->save())
                return redirect()->route(currentUser().'.invloc.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function show(Location $location)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invloc=InventoryLocation::findOrFail(encryptor('decrypt',$id));
        return view('settings.invlocations.edit',compact('invloc'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $inv_loc=InventoryLocation::findOrFail(encryptor('decrypt',$id));
            $inv_loc->name=$request->name;
            if($inv_loc->save())
                return redirect()->route(currentUser().'.invloc.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy(Location $location)
    {
        //
    }
}
