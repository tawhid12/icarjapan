<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PurchasedVehicle;
use App\Models\Vehicle\Vehicle;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;
use DB;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (currentUser() == 'salesexecutive') {
            $payments = Payment::where('created_by', currentUserId())->get();
            return view('sales.payment.index', compact('payments'));
        } elseif (currentUser() == 'user') {
            $payments = Payment::where('customer_id', 3)->get();
            countryIp();
            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('user.payment.index', compact('payments','location'));
            }
        } else {
            $payments = Payment::all();
            return view('superadmin.payment.index', compact('payments'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->filled('id')) {
            $invoice = Invoice::find($request->id);
            return view('sales.payment.create-payment', compact('invoice'));
        }
        $invoices = Invoice::where('executive_id', currentUserId())->get();
        return view('sales.payment.create', compact('invoices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $inv = Invoice::where('id', $request->invoice_id)->first();
            if ($inv)
                $fob_amt  = $inv->inv_amount;
            else
                $fob_amt = 0;
            $paid_amt = Payment::where(['reserve_id' => $request->reserve_id, 'client_id' => $request->client_id])->sum('amount');
            /*echo $fob_amt . '<br>';
            echo $request->amount + $paid_amt;
            die;*/
            //$deposit_amt = Payment::whereNull('invoice_id')->where('customer_id', $request->customer_id)->sum('deposit');

            /*echo '<pre>';
            print_r($inv->toArray());die;*/
            if ($request->amount + $paid_amt + $request->deduction > $fob_amt) {
                return redirect()->back()->withInput()->with(Toastr::error('Paid Amount Greater Than Due Amount!', 'Fail', ["positionClass" => "toast-top-right"]));
            } else {
                $payment = new Payment();
                if ($request->adjust_deposit == 1) {

                    $vehicle = Vehicle::find($inv->vehicle_id);
                    $vehicle->sold_status = 1;
                    $vehicle->save();

                    $payment->invoice_id = $request->invoice_id;
                    $payment->created_by  = currentUserId();
                    $payment->receive_date = date('Y-m-d', strtotime($request->receive_date));
                    $payment->currency_type = $request->currency_type;
                    $payment->reserve_id = $request->reserve_id;
                    $payment->amount = $request->amount;
                    /*=== user balance will be duduct ===*/
                    $deposit_update = DB::table('deposits')->where('client_id', $request->client_id)->update(['deduction' => -$request->deduction, 'merged_by' => currentUserId(), 'merge_date' => date('Y-m-d', strtotime($request->receive_date)), 'payment_id' => $request->payment_id, 'updated_by' => currentUserId()]);
                    /*== deposit+$request->amount+$paid_amt == fob_amt (vechicle sold out) and data insert to purchased table==*/
                    if ($deposit_update) {
                        $deposit_merge = new Payment();
                        $deposit_merge->invoice_id = $request->invoice_id;
                        $deposit_merge->created_by  = currentUserId();
                        $deposit_merge->receive_date = date('Y-m-d', strtotime($request->receive_date));
                        $deposit_merge->currency_type = $request->currency_type;
                        $deposit_merge->reserve_id = $request->reserve_id;
                        $deposit_merge->type = 2;
                        $deposit_merge->amount = $request->deduction;
                        $deposit_merge->client_id = $inv->client_id;
                        $deposit_merge->save();
                    }
                    if ($fob_amt == $request->amount + $request->deduction) {
                        /* Insert Data Into Purchase Table */
                        $pur_vehicle = new PurchasedVehicle();
                        $pur_vehicle->vehicle_id = $inv->vehicle_id;
                        $pur_vehicle->reserve_id = $inv->reserve_id;
                        $pur_vehicle->invoice_id = $inv->id;
                        $pur_vehicle->executive_id = $request->executive_id;
                        $pur_vehicle->customer_id = $inv->client_id;
                        $pur_vehicle->sale_date = date('Y-m-d', strtotime($request->receive_date));
                        $pur_vehicle->save();
                    }
                } elseif ($fob_amt == $request->amount + $paid_amt) {
                    /*===Vehicle Will Be Sold Out ===*/
                    if ($request->amount) {
                        $vehicle = Vehicle::find($inv->vehicle_id);
                        $vehicle->sold_status = 1;
                        $vehicle->save();



                        /* Insert Data Into Purchase Table */
                        $pur_vehicle = new PurchasedVehicle();
                        $pur_vehicle->vehicle_id = $inv->vehicle_id;
                        $pur_vehicle->reserve_id = $inv->reserve_id;
                        $pur_vehicle->invoice_id = $inv->id;
                        $pur_vehicle->executive_id = $request->executive_id;
                        $pur_vehicle->customer_id = $inv->client_id;
                        $pur_vehicle->sale_date = date('Y-m-d', strtotime($request->receive_date));
                        $pur_vehicle->save();
                    }
                }
                $payment->invoice_id = $request->invoice_id;
                $payment->created_by  = currentUserId();
                $payment->receive_date = date('Y-m-d', strtotime($request->receive_date));
                $payment->currency_type = $request->currency_type;
                $payment->reserve_id = $request->reserve_id;
                $payment->amount = $request->amount;
                //$payment->allocated = $request->allocated;
                /*if($request->allocated && $request->amount >= $request->allocated){
                    $payment->deposit = $request->amount - $request->allocated;
                }else{
                    $payment->deposit = $request->deposit;
                }*/
                //$payment->security_deposit	 = $request->security_deposit;
                //$payment->deposit = $request->deposit;
                $payment->type     = $request->type;
                $payment->client_id = $request->client_id;
                $payment->paid_by = currentUserId();
                $payment->created_by = currentUserId();
            }




            if ($payment->save()) {
                /*== Save Deposit to user Balance ==*/
                if ($request->deposit) {
                    $user = User::where('id', $request->customer_id)->first();
                    $user->deposit_bal +=  $request->deposit;
                    $user->save();
                }
                return redirect()->route(currentUser() . '.client_individual', encryptor('encrypt', $request->client_id))->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            } else {
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $invoice = Invoice::find($id);
        return view('sales.payment.create-payment', compact('invoice', 'id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Payment $payment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Payment  $payment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Payment $payment)
    {
        //
    }
}
