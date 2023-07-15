<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\PurchasedVehicle;
use App\Models\Vehicle\Vehicle;
use App\Models\Invoice;
use App\Models\User;
use Illuminate\Http\Request;
use Toastr;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(currentUser() == 'salesexecutive'){
            $payments = Payment::where('created_by',currentUserId())->get();
            return view('sales.payment.index', compact('payments'));
        }elseif(currentUser() == 'user'){
            $payments = Payment::where('customer_id',3)->get();
            return view('user.payment.index', compact('payments'));
        }else{
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
        if($request->filled('id')){
            $invoice = Invoice::find($request->id);
            return view('sales.payment.create-payment',compact('invoice'));
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
            $inv = Invoice::where('id',$request->invoice_id)->first();
                if($inv)
                $fob_amt  = $inv->fob_amt;
                else
                $fob_amt = 0;
            $paid_amt = Payment::where(['invoice_id'=>$request->invoice_id,'customer_id' => $request->customer_id])->sum('amount');
            $deposit_amt = Payment::whereNull('invoice_id')->where('customer_id',$request->customer_id)->sum('deposit');

            /*echo '<pre>';
            print_r($inv->toArray());die;*/

            $payment = new Payment();
            if($request->adjust_deposit == 1){
                /*=== user balance will be duduct ===*/

                /*== deposit+$request->amount+$paid_amt == fob_amt (vechicle sold out) and data insert to purchased table==*/

            }elseif($fob_amt == $request->amount+$paid_amt){
                /*===Vehicle Will Be Sold Out ===*/
                $vehicle = Vehicle::find($inv->vehicle_id);
                $vehicle->sold_status = 1;
                $vehicle->save();

                /* Insert Data Into Purchase Table */
                $pur_vehicle = New PurchasedVehicle();
                $pur_vehicle->vehicle_id = $inv->vehicle_id;
                $pur_vehicle->reserve_id = $inv->reserve_id;
                $pur_vehicle->invoice_id = $inv->id;
                $pur_vehicle->executive_id = $inv->executive_id;
                $pur_vehicle->customer_id = $inv->customer_id;
                $pur_vehicle->sale_date = date('Y-m-d',strtotime($request->receive_date));
                $pur_vehicle->save();
            }

            $payment->invoice_id = $request->invoice_id;
            $payment->created_by  = currentUserId();
            $payment->receive_date = date('Y-m-d',strtotime($request->receive_date));
            $payment->currency = $request->currency;
            $payment->amount = $request->amount;
            $payment->allocated = $request->allocated;
            /*if($request->allocated && $request->amount >= $request->allocated){
                $payment->deposit = $request->amount - $request->allocated;
            }else{
                $payment->deposit = $request->deposit;
            }*/
            //$payment->security_deposit	 = $request->security_deposit;
            $payment->deposit = $request->deposit;
            $payment->type	 = $request->type;
            $payment->customer_id = $request->customer_id;
            $payment->created_by = currentUserId();
            
            if ($payment->save()) {
                /*== Save Deposit to user Balance ==*/
                if($request->deposit){
                    $user = User::where('id', $request->customer_id)->first();
                    $user->deposit_bal +=  $request->deposit;
                    $user->save();
                }
                return redirect()->route(currentUser() . '.payment.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
    public function show(Payment $payment)
    {
        //
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
