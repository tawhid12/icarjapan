<?php

namespace App\Http\Controllers\Vehicle;
use App\Http\Controllers\Controller;

use App\Models\Vehicle\Door;
use Illuminate\Http\Request;

use App\Http\Requests\Vehicle\Color\AddNewRequest;
use App\Http\Requests\Vehicle\Color\UpdateRequest;

use Toastr;

class DoorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doors=Door::latest()->paginate(15);
        return view('vehicle.door.index',compact('doors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.door.create');
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
            $d=new Door();
            $d->name=$request->name;
            $d->created_by=currentUserId();
            if($d->save())
                return redirect()->route(currentUser().'.door.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function show(Door $door)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $door=Door::findOrFail(encryptor('decrypt',$id));
        return view('vehicle.door.edit',compact('door'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try{
            $d=Door::findOrFail(encryptor('decrypt',$id));
            $d->name=$request->name;
            $d->updated_by=currentUserId();
            if($d->save())
                return redirect()->route(currentUser().'.door.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Door  $door
     * @return \Illuminate\Http\Response
     */
    public function destroy(Door $door)
    {
        //
    }
}
