<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\SubBodyType;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\SubBodyType\AddNewRequest;
use App\Http\Requests\Settings\SubBodyType\UpdateRequest;

use Toastr;

class SubBodyTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sub_body_types=SubBodyType::latest()->paginate(15);
        return view('settings.subbodytype.index',compact('sub_body_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.subbodytype.create');
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
            $sbd=new SubBodyType();
            $sbd->name=$request->name;
            if($sbd->save())
                return redirect()->route(currentUser().'.subbodytype.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\SubBodyType  $subBodyType
     * @return \Illuminate\Http\Response
     */
    public function show(SubBodyType $subBodyType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubBodyType  $subBodyType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $subbodytype=SubBodyType::findOrFail(encryptor('decrypt',$id));
        return view('settings.subbodytype.edit',compact('subbodytype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubBodyType  $subBodyType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $sbt=SubBodyType::findOrFail(encryptor('decrypt',$id));
            $sbt->name=$request->name;
            if($sbt->save())
                return redirect()->route(currentUser().'.subbodytype.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\SubBodyType  $subBodyType
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubBodyType $subBodyType)
    {
        //
    }
}
