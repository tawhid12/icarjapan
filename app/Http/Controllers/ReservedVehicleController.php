<?php

namespace App\Http\Controllers;

use App\Models\FavouriteVehicle;
use App\Models\Invoice;
use App\Models\ReservedVehicle;
use App\Models\Notification;
use App\Models\User;
use App\Models\Vehicle\Vehicle;
use App\Models\Notify;
use App\Jobs\SendReserveCancelEmailJOb;
use Illuminate\Http\Request;
use Toastr;
use Carbon\Carbon;
use DB;

class ReservedVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (currentUser() == 'superadmin') {
            $resrv = ReservedVehicle::orderBy('id', 'DESC')->paginate(25);
            return view('vehicle.resrv_vehicle.index', compact('resrv'));
        } elseif (currentUser() == 'salesexecutive') {
            $resrv = ReservedVehicle::where('assign_user_id', currentUserId())->orderBy('id', 'DESC')->paginate(25);
            return view('vehicle.resrv_vehicle.index', compact('resrv'));
        } else {
            $resrv = ReservedVehicle::where('user_id', currentUserId())->orderBy('id', 'DESC')->paginate(25);

            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');

            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('user.resrv_vehicle.index', compact('resrv', 'location'));
            } else {
                countryIp();
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (currentUser() == 'salesexecutive') {
            $users = User::where('created_by', currentUserId())->paginate(10);
        }
        return view('vehicle.resrv_vehicle.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);

        $vehicle = Vehicle::find($request->vehicle_id);

        if (is_null($vehicle->r_status)) {
            try {
                $b = new ReservedVehicle();
                $b->vehicle_id = $request->vehicle_id;
                if (currentUser() == 'user') {
                    $b->user_id = currentUserId();
                    $b->created_by = currentUserId();
                } else {
                    $b->user_id = $request->user_id;
                    $b->assign_user_id = currentUserId();
                    $b->created_by = currentUserId();

                    /*=== Update Executive Id into  Users Table to assign Executive to user ===*/
                    $user = User::where('id', $request->user_id)->update(['executiveId' => currentUserId(), 'type' => 1]);
                }
                /* Check Shipment Type RORO or Container if container what is price need to ask but roro will calculate*/
                //if ($request->shipment_type == 1) {
                    $user = DB::table('users')->where('id', $request->user_id)->first();

                    $country_data = DB::table('countries')->where('id', $user->country_id)->first();
                    $b->insp_amt =  $request->insp_amt == 1 ? $country_data->inspection : 0;
                    $b->insu_amt =  $request->insu_amt == 1 ? $country_data->insurance : 0;

                    if (is_null($user->port_id)) {
                        return redirect()->back()->with(Toastr::error('Please Select Port For User!', 'Fail', ["positionClass" => "toast-top-right"]));
                    }
                    $port_data = DB::table('ports')->where('id', $user->port_id)->first();

                    if ($vehicle->m3 == 0.00) {
                        return redirect()->back()->with(Toastr::error('M3 Value can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
                    }
                    $b->m3_value = $vehicle->m3 ? $vehicle->m3 : 0;
                    if ($port_data->m3 == 0.00) {
                        return redirect()->back()->with(Toastr::error('M3 Charge can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
                    }
                    $b->m3_charge = $port_data->m3;

                    if (isset($port_data->aditional_cost))
                        $b->aditional_cost = $port_data->aditional_cost;
                    else
                        $b->aditional_cost =  0;
                //}
                $b->shipment_type =  1 /*$request->shipment_type*/;
                $b->fob_amt = $vehicle->price ? $vehicle->price : 0.00;
                $b->discount = $vehicle->sp_dis ? $vehicle->sp_dis : 0.00;



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
                    return redirect()->back()->with(Toastr::success('Reserved Request Received!', 'Success', ["positionClass" => "toast-top-right"]));
                } else {
                    return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                }
            } catch (Exception $e) {
                //dd($e);
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } else {
            // Redirect user to intended URL
            return redirect()->back()->with(Toastr::error('Vehicle  Reserved !!', 'Success', ["positionClass" => "toast-top-right"]));
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
        //return view()
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


        try {
            //dd($request->toArray());
            $resv = ReservedVehicle::findOrFail(encryptor('decrypt', $id));
            $vehicle = Vehicle::find($resv->vehicle_id);
            if (currentUser() == 'accountant') {
                DB::connection()->enableQueryLog();
                $total_paid = DB::table('payments')
                    ->join('invoices', 'payments.client_id', 'invoices.client_id')
                    ->where('payments.client_id', $resv->user_id)
                    ->where('invoices.invoice_type', 1)
                    ->sum('payments.amount');
                $queries = \DB::getQueryLog();
                //dd($queries);
                $total_allocate = DB::table('reserved_vehicles')->where('user_id', $resv->user_id)->sum('allocated');
                /*echo $total_paid ."<br>";
                echo $total_allocate."<br>";
                echo $request->allocate;
                die;*/
                if ($total_paid - $total_allocate > 0 && $request->allocate <= $total_paid - $total_allocate) {
                    $resv->allocated = $request->allocate;
                } else {
                    return redirect()->back()->with(Toastr::error($total_paid - $total_allocate . ' Allocation Available!', 'error', ["positionClass" => "toast-top-right"]));
                }
            }
            if (currentUser() == 'salesexecutive' || currentUser() == 'superadmin') {
                //echo '<pre>'; print_r($resv);die;


                /* Check Shipment Type RORO or Container if container what is price need to ask but roro will calculate*/
                if ($resv->shipment_type == 2) {
                    $resv->freight_amt = $request->freight_amt;
                    $resv->insp_amt = $request->insp_amt;
                    $resv->insu_amt = $request->insu_amt;
                    $resv->m3_value = $request->m3_value;
                    $resv->m3_charge = $request->m3_charge;
                    $resv->aditional_cost =  $request->aditional_cost;
                    $resv->fob_amt = $request->fob_amt;
                }



                if ($request->status == 2) {
                    /* If Reserve By Customer need to update assisgn_user_id of reserve table and executiveId of users table */
                    if ($resv->assign_user_id == null) {
                        $resv->assign_user_id = currentUserId();
                        $user = User::find($resv->user_id);
                        $user->type = 1;
                        $user->executiveId = currentUserId();
                        $user->save();
                    }
                    /*Insert To Proforma Invoice */
                    if (Invoice::where('vehicle_id', $resv->vehicle_id)->where('reserve_id', $resv->id)->where('invoice_type', 1)->doesntExist()) {
                        $invoice = new Invoice();
                        $invoice->invoice_type = 1;
                        $invoice->invoice_date = date('Y-m-d');
                        $invoice->reserve_id =  $resv->id;
                        $invoice->vehicle_id = $resv->vehicle_id;
                        $invoice->client_id     = $resv->user_id;
                        //$invoice->fob_amt = $resv->settle_price;
                        $invoice->executiveId = $resv->assign_user_id;

                        $invoice->inv_amount = $resv->total ? $resv->total : 0.00;
                        $invoice->save();
                    }
                    $resv->status = 2;
                }
                $resv->discount =  $vehicle->sp_dis ? $vehicle->sp_dis : 0.00;
                $resv->total();

                $invoice = Invoice::where('reserve_id', $resv->id)->where('invoice_type', 1)->first();
                $invoice->inv_amount =  $resv->total ? $resv->total : 0.00;

                $invoice->save();
                /* Send Proforma Invoice To User with mail */
            }
           if($request->required_deposit)
           $resv->required_deposit =  $request->required_deposit;
           else
            $resv->required_deposit =  floor($resv->total >= 0.5) ? ceil($resv->total*0.5) : floor($resv->total*0.5);
            $resv->updated_by = currentUserId();
            if ($resv->save()) {
                return redirect()->back()->with(Toastr::success('Reserved Request Received!', 'Success', ["positionClass" => "toast-top-right"]));
                //return redirect()->route(currentUser() . '.reservevehicle.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
    public function destroy($id)
    {
        $notify = Notify::where(['vehicle_id' => $id, 'status' => 2])->get();
        foreach ($notify as $n) {
            /*To User */
            $user = User::where('id', $n->user_id)->first();
            $v_data = Vehicle::where('id', $n->vehicle_id)->first();
            /*echo $user->email;
            die;*/
            \Mail::send('mail.reply_reserve_cancel', ['notify' => $n], function ($message) use ($n, $v_data, $user) {
                $message->from('info@icarjapan.com', 'Icarjapan')
                    ->to($user->email)
                    ->subject('Reserved Free For ' . $v_data->name . ' and Stock Id ' . $v_data->stock_id);
            });
            /*== Notify Cancel Update ==*/
            $notify  =  Notify::find($n->id);
            $notify->status = 1;
            $notify->save();

            /*== Reserve Vehicle Cancel ==*/
            $resv = ReservedVehicle::findOrFail($id);
            $resv->status = 3;
            $resv->save();
        }

        /*== Notify Vehicle Cancel Update ==*/
        $vehicle = Vehicle::findOrFail($id);
        $vehicle->r_status = null;
        if ($vehicle->save()) {
            return redirect()->route(currentUser() . '.reservevehicle.index')->with(Toastr::success('Reserve Cancel!', 'Success', ["positionClass" => "toast-top-right"]));
        } else {
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
    public function reserve_cancel(Request $request)
    {
        $id = $request->id;
        $reserveId =  $request->reserveId;
        if ($id && $reserveId) {
            $notify = FavouriteVehicle::where(['vehicle_id' => $id, 'user_id' => currentUserId(), 'status' => 2])->get();
            foreach ($notify as $n) {
                /*echo '<pre>';
                print_r($n);die;*/
                dispatch(new SendReserveCancelEmailJOb($n));
                /*== Favourite Status Update ==*/
                $notify  =  FavouriteVehicle::find($n->id);
                $notify->status = 1;
                $notify->save();
            }
            /*== Reserve Vehicle Cancel ==*/
            $resv = ReservedVehicle::findOrFail($reserveId);
            $resv->status = 3;
            $resv->save();

            /*== Notify Vehicle Cancel Update ==*/
            $vehicle = Vehicle::findOrFail($id);
            $vehicle->r_status = null;
            $vehicle->save();

            return redirect()->back()->with(Toastr::success('Reserve Cancel!', 'Success', ["positionClass" => "toast-top-right"]));
        } else {
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
    public function reserve_calculate(Request $request)
    {

        $vehicle = Vehicle::find($request->vehicle_id);
        $resv = ReservedVehicle::findOrFail($request->reserve_id);
       
        /* Check Shipment Type RORO or Container if container what is price need to ask but roro will calculate*/
        if ($resv->shipment_type == 1) {

            $user = DB::table('users')->where('id', $resv->user_id)->first();

            $country_data = DB::table('countries')->where('id', $user->country_id)->first();
            $resv->insp_amt =  $request->insp_amt == 1 ? $country_data->inspection : 0;
            $resv->insu_amt =  $request->insu_amt == 1 ? $country_data->insurance : 0;

            if (is_null($user->port_id)) {
                return redirect()->back()->with(Toastr::error('Please Select Port For User!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            $port_data = DB::table('ports')->where('id', $user->port_id)->first();

            if ($vehicle->m3 == 0.00) {
                return redirect()->back()->with(Toastr::error('M3 Value can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            $resv->m3_value = $vehicle->m3 ? $vehicle->m3 : 0;
            if ($port_data->m3 == 0.00) {
                return redirect()->back()->with(Toastr::error('M3 Charge can not be Zero!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
            $resv->m3_charge = $port_data->m3;

            if (isset($port_data->aditional_cost))
                $resv->aditional_cost = $port_data->aditional_cost;
            else
                $resv->aditional_cost =  0;
        }
        $resv->shipment_type =  $request->shipment_type;
        $resv->fob_amt = $vehicle->price ? $vehicle->price : 0.00;
        $resv->discount = $vehicle->sp_dis ? $vehicle->sp_dis : 0.00;
        $resv->total();
        /*Insert To Proforma Invoice */
        if (Invoice::where('vehicle_id', $resv->vehicle_id)->where('reserve_id', $resv->id)->where('invoice_type', 1)->doesntExist()) {
            $invoice = new Invoice();
            $invoice->invoice_type = 1;
            $invoice->invoice_date = date('Y-m-d');
            $invoice->reserve_id =  $resv->id;
            $invoice->vehicle_id = $resv->vehicle_id;
            $invoice->client_id     = $resv->user_id;
            //$invoice->fob_amt = $resv->settle_price;
            $invoice->executiveId = $resv->assign_user_id;

            $invoice->inv_amount = $resv->total ? $resv->total : 0.00;
            $invoice->save();
        }
        $invoice = Invoice::where('reserve_id', $resv->id)->where('invoice_type', 1)->first();
        $invoice->inv_amount =  $resv->total ? $resv->total : 0.00;

        if($request->required_deposit > 0)
           $resv->required_deposit =  $request->required_deposit;
        else
            $resv->required_deposit =  floor($resv->total >= 0.5) ? ceil($resv->total*0.5) : floor($resv->total*0.5);

        $invoice->save();
        if ($resv->save()) {
        
            return redirect()->back()->with(Toastr::success('Shipment Type Updated', 'error', ["positionClass" => "toast-top-right"]));
        }
    }
}
