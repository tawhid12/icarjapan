<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\ReservedVehicle;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vehicle\Vehicle;

use Illuminate\Http\Request;
use Toastr;

class ReservedVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $resrv = ReservedVehicle::orderBy('id', 'DESC')->paginate(25);
        return view('vehicle.resrv_vehicle.index', compact('resrv'));
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
        if (is_null($vehicle->r_status)) {
            try {
                $b = new ReservedVehicle();
                $b->vehicle_id = $request->vehicle_id;
                $b->user_id = currentUserId();
                $b->created_by = currentUserId();

                if ($b->save()) {

                    $vehicle->r_status = 1;
                    $vehicle->save();

                    $notification = new Notification();
                    $notification->user_id = currentUserId();
                    $notification->title = 'Vehicle Reserved ' . $vehicle->fullName;
                    $notification->click_url = route('superadmin.reservevehicle.show', $b->id);
                    $notification->read_status = 0;
                    $notification->type = 1;
                    $notification->save();
                    // Redirect user to intended URL
                    return redirect()->back()->with(Toastr::success('Reserved Request Received!', 'Success', ["positionClass" => "toast-top-right"]));;
                } else {
                    return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            } catch (Exception $e) {
                //dd($e);
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $notification = Notification::findOrFail($id);
        $notification->read_status = 1;
        $notification->save();
        return redirect()->route(currentUser() . '.reservevehicle.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = User::whereIn('role_id', [3])->with('role')->orderBy('id', 'DESC')->get();
        /*echo '<pre>';
        print_r($users);die;*/
        $resv = ReservedVehicle::find($id);
        return view('vehicle.resrv_vehicle.edit', compact('resv', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $resv = ReservedVehicle::findOrFail(encryptor('decrypt', $id));
        try {
            $resv = ReservedVehicle::findOrFail(encryptor('decrypt', $id));
            if (currentUser() == 'superadmin') {
                $resv->assign_user_id = $request->assign_user_id;
            }
            if (currentUser() == 'salesexecutive') {
                $resv->confirm_on = date('Y-m-d', strtotime($request->confirm_on));
                $resv->settle_price = $request->settle_price;
                $resv->note = $request->note;
                $resv->status = $request->status;

                /*Insert To Invoice */
                if(Invoice::where('vehicle_id',$resv->vehicle_id)->doesntExist()){
                $invoice = New Invoice();
                $invoice->invoice_date = date('Y-m-d');
                $invoice->reserve_id =  $resv->id;
                $invoice->vehicle_id = $resv->vehicle_id;
                $invoice->customer_id = $resv->user_id;
                $invoice->executive_id = $resv->assign_user_id;
                $invoice->save();
                }
            }
            $resv->updated_by = currentUserId();
            if ($resv->save()) {
                return redirect()->route(currentUser() . '.reservevehicle.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            } else {
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ReservedVehicle  $reservedVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(ReservedVehicle $reservedVehicle)
    {
        //
    }
}