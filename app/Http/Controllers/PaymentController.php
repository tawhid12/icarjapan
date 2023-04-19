<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Invoice;
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
        }elseif(currentUser() == 'user'){
            $payments = Payment::where('customer_id',3)->get();
        }else{
            $payments = Payment::all();
        }
        
        return view('user.payment.index', compact('payments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $invoices = Invoice::where('executive_id', currentUserId())->get();
        return view('user.payment.create', compact('invoices'));
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
            $payment = new Payment();
            
            $payment->invoice_id = 1;
            $payment->receive_date = date('Y-m-d',strtotime($request->receive_date));
            $payment->currency = $request->currency;
            $payment->amount = $request->amount;
            $payment->allocated = $request->allocated;
            $payment->deposit = $request->deposit;
            $payment->security_deposit	 = $request->security_deposit;
            $payment->type	 = $request->type;
            $payment->customer_id = 3;
            $payment->created_by = currentUserId();
            
            if ($payment->save()) {
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
