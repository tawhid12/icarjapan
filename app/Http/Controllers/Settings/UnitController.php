<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\Unit;
use App\Models\Settings\UnitStyle;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\Unit\AddNewRequest;
use App\Http\Requests\Settings\Unit\UpdateRequest;

use Toastr;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $units=Unit::latest()->paginate(15);
        return view('settings.unit.index',compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $unitstyles=UnitStyle::orderBy('name')->get();
        return view('settings.unit.create',compact('unitstyles'));
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
            $data=new Unit;
            $data->unit_style_id=$request->unit_style_id;
            $data->name=$request->name;
            $data->qty=$request->qty;
            $data->status=1;
            if($data->save())
                return redirect()->route(currentUser().'.unit.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function show(Unit $unit)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settimgs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unitstyles=UnitStyle::all();
        $unit=Unit::findOrFail(encryptor('decrypt',$id));
        return view('settings.unit.edit',compact('unit','unitstyles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settimgs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $data=Unit::findOrFail(encryptor('decrypt',$id));
            $data->unit_style_id=$request->unit_style_id;
            $data->name=$request->name;
            $data->qty=$request->qty;
            $data->status=$request->status;
            if($data->save())
                return redirect()->route(currentUser().'.unit.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Unit  $unit
     * @return \Illuminate\Http\Response
     */
    public function destroy(Unit $unit)
    {
        //
    }
}
