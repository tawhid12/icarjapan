<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\BodyType;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\BodyType\AddNewRequest;
use App\Http\Requests\Settings\BodyType\UpdateRequest;

use Toastr;

class BodyTypeController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $body_types=BodyType::latest()->paginate(15);
        return view('settings.bodytype.index',compact('body_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.bodytype.create');
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
            $bd=new BodyType();
            $bd->name=$request->name;
            if($bd->save())
                return redirect()->route(currentUser().'.bodytype.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settimgs\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $bodytype=BodyType::findOrFail(encryptor('decrypt',$id));
        return view('settings.bodytype.edit',compact('bodytype'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settimgs\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $bt=BodyType::findOrFail(encryptor('decrypt',$id));
            $bt->name=$request->name;
            if($bt->save())
                return redirect()->route(currentUser().'.bodytype.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Designation  $designation
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designation $designation)
    {
        //
    }
}
