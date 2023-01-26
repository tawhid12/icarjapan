<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\DriveType;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\DriveType\AddNewRequest;
use App\Http\Requests\Settings\DriveType\UpdateRequest;

use Toastr;

class DriveTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $drive_types=DriveType::latest()->paginate(15);
        return view('settings.drivetype.index',compact('drive_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.drivetype.create');
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
            $d=new DriveType();
            $d->name=$request->name;
            if($d->save())
                return redirect()->route(currentUser().'.drivetype.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function show(Drive $drive)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $drive=DriveType::findOrFail(encryptor('decrypt',$id));
        return view('settings.drivetype.edit',compact('drive'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $d=DriveType::findOrFail(encryptor('decrypt',$id));
            $d->name=$request->name;
            if($d->save())
                return redirect()->route(currentUser().'.drivetype.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Drive  $drive
     * @return \Illuminate\Http\Response
     */
    public function destroy(Drive $drive)
    {
        //
    }
}
