<?php

namespace App\Http\Controllers;

use App\Models\Notify;
use App\Models\User;
use App\Models\Vehicle\Vehicle;
use App\Models\ReservedVehicle;
use Illuminate\Http\Request;
use Toastr;
use DB;
class NotifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $vehicle = Vehicle::find($request->vehicle_id);
        $user_data = User::where('id',currentUserId())->first();
        $reserve_data = ReservedVehicle::where(['vehicle_id' => $request->vehicle_id,'status' => 1])->first();
        $notify_data = Notify::where(['user_id' => $user_data->id,'vehicle_id' => $request->vehicle_id,'status' => 2])->first();
        if($notify_data){
            /*echo '<pre>';
            print_r($notify_data->toArray());die;*/
            return redirect()->back()->with(Toastr::error('Notification Already Exists!', 'Success', ["positionClass" => "toast-top-right"]));
        }else{
            if ($vehicle->r_status) {
                try {
                    $n = new Notify();
                    $n->vehicle_id = $request->vehicle_id;
                    $n->user_id = currentUserId();
                    $n->reserve_id = $reserve_data->id;
                    $n->status = 2;
                    $n->created_by = currentUserId();
                    $n->save();
                    }catch (Exception $e) {
                        //dd($e);
                        return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                    }
            }
        }
        return redirect()->back()->with(Toastr::success('You Will Get Email Notification !!', 'Success', ["positionClass" => "toast-top-right"]));
       /*else{
            // Redirect user to intended URL
            return redirect()->back()->with(Toastr::error('Vehicle  Reserved !!', 'Success', ["positionClass" => "toast-top-right"]));
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function show(Notify $notify)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function edit(Notify $notify)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notify $notify)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notify  $notify
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notify $notify)
    {
        //
    }
}
