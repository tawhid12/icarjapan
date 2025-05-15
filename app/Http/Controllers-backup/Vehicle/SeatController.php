<?php

namespace App\Http\Controllers\Vehicle;
use App\Http\Controllers\Controller;

use App\Models\Vehicle\Seat;
use Illuminate\Http\Request;

use App\Http\Requests\Vehicle\Seat\AddNewRequest;
use App\Http\Requests\Vehicle\Seat\UpdateRequest;

use Toastr;

class SeatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $seats=Seat::latest()->paginate(15);
        return view('vehicle.seat.index',compact('seats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vehicle.seat.create');
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
            $s=new Seat();
            $s->name=$request->name;
            $s->created_by=currentUserId();
            if($s->save())
                return redirect()->route(currentUser().'.seat.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function show(Seat $seat)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $seat=Seat::findOrFail(encryptor('decrypt',$id));
        return view('vehicle.seat.edit',compact('seat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $s=Seat::findOrFail(encryptor('decrypt',$id));
            $s->name=$request->name;
            $s->updated_by=currentUserId();
            if($s->save())
                return redirect()->route(currentUser().'.seat.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Seat  $seat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Seat $seat)
    {
        //
    }
}
