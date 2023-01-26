<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\UnitStyle;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\UnitStyle\AddNewRequest;
use App\Http\Requests\Settings\UnitStyle\UpdateRequest;
use Toastr;

class UnitStyleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $unitstyles=UnitStyle::latest()->paginate(15);
        return view('settings.unitstyle.index',compact('unitstyles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.unitstyle.create');
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
            $dep=new UnitStyle;
            $dep->name=$request->name;
            if($dep->save())
                return redirect()->route(currentUser().'.unitstyle.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\UnitStyle  $unitstyle
     * @return \Illuminate\Http\Response
     */
    public function show(UnitStyle $unitstyle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settimgs\UnitStyle  $unitstyle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unitstyle=UnitStyle::findOrFail(encryptor('decrypt',$id));
        return view('settings.unitstyle.edit',compact('unitstyle'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settimgs\UnitStyle  $unitstyle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $dep=UnitStyle::findOrFail(encryptor('decrypt',$id));
            $dep->name=$request->name;
            if($dep->save())
                return redirect()->route(currentUser().'.unitstyle.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\UnitStyle  $unitstyle
     * @return \Illuminate\Http\Response
     */
    public function destroy(UnitStyle $unitstyle)
    {
        //
    }
}
