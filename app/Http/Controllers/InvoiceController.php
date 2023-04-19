<?php

namespace App\Http\Controllers;

use App\Models\ConsigneeDetail;
use App\Models\Invoice;
use App\Models\ReservedVehicle;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use Illuminate\Http\Request;
use App\Http\Traits\ImageHandleTraits;
use Toastr;

class InvoiceController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (currentUser() == 'salesexecutive') {
            $invoices = Invoice::where('executive_id',currentUserId())->paginate(10);
        }else if(currentUser() == 'user'){
            $invoices = Invoice::where('customer_id',currentUserId())->paginate(10);
        }else{
            $invoices = Invoice::paginate(10);
        }
        return view('user.invoice.index',compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $resrv = ReservedVehicle::where('assign_user_id',currentUserId())->get();
        $countries = Country::all();
        return view('user.invoice.create',compact('countries','resrv'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $inv = Invoice::find(encryptor('decrypt',$id));
        return view('user.invoice.show',compact('inv'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $inv = Invoice::find(encryptor('decrypt',$id));
        $countries = Country::all();
        $ports = Port::all();
        return view('user.invoice.edit',compact('inv','countries','ports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $inv = Invoice::findOrFail(encryptor('decrypt', $id));
            $inv->auc_country_id = $request->auc_country_id;
            $inv->des_country_id = $request->des_country_id;
            $inv->fob_amt = $request->fob_amt;
            $inv->freight_amt = $request->freight_amt;
            $inv->insu_amt = $request->insu_amt;
            $inv->insp_amt = $request->insp_amt;
            $inv->van_amt = $request->van_amt;
            $inv->v_bus_amt = $request->v_bus_amt;
            $inv->other_cost = $request->other_cost;
            $inv->discount = $request->discount;
            $inv->ins_req_date = date('Y-m-d',strtotime($request->ins_req_date));
            $inv->ins_pass_date = date('Y-m-d',strtotime($request->ins_pass_date));
            $inv->dep_port_id = $request->dep_port_id;
            $inv->des_port_id = $request->des_port_id;
            $inv->ship_name = $request->ship_name;
            $inv->voyage_no = $request->voyage_no;
            $inv->est_arival_date = date('Y-m-d',strtotime($request->est_arival_date));
            $inv->consignee_id = $request->consignee_id;
            $inv->tracking_no = $request->tracking_no;
            $inv->shipping_date = date('Y-m-d',strtotime($request->shipping_date));
            $inv->updated_by = currentUserId();
            if($request->has('bill_of_land_1_url')) $inv->bill_of_land_1_url = $this->uploadImage($request->file('bill_of_land_1_url'), 'uploads/bill_of_land_1_url');
            if($request->has('bill_of_land_2_url')) $inv->bill_of_land_2_url = $this->uploadImage($request->file('bill_of_land_2_url'), 'uploads/bill_of_land_2_url');
            if($request->has('exp_can_cer_url_1')) $inv->exp_can_cer_url_1 = $this->uploadImage($request->file('exp_can_cer_url_1'), 'uploads/exp_can_cer_url_1');
            if($request->has('exp_can_cer_url_2')) $inv->exp_can_cer_url_2 = $this->uploadImage($request->file('exp_can_cer_url_2'), 'uploads/exp_can_cer_url_2');
            if ($inv->save()) {
                return redirect()->route(currentUser() . '.invoice.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
