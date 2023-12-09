<?php

namespace App\Http\Controllers;

use App\Models\ShipmentDetail;
use App\Models\User;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use App\Models\ConsigneeDetail;
use App\Http\Traits\ImageHandleTraits;
use Illuminate\Http\Request;
use Toastr;
use DB;

class ShipmentDetailController extends Controller
{
    use ImageHandleTraits;
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
        $shipment_exixts = ShipmentDetail::where('reserve_id', $request->reserve_id)->first();
        try {
            if (!$shipment_exixts) {
                $shipment = new ShipmentDetail();
                $shipment->reserve_id = $request->reserve_id;
                $shipment->vehicle_id = $request->vehicle_id;
                $shipment->client_id = $request->client_id;
                $shipment->auc_country_id = $request->auc_country_id;
                $shipment->des_country_id = $request->des_country_id;
                $shipment->ins_req_date = date('Y-m-d', strtotime($request->ins_req_date));
                $shipment->ins_pass_date = date('Y-m-d', strtotime($request->ins_pass_date));
                $shipment->dep_port_id = $request->dep_port_id;
                $shipment->des_port_id = $request->des_port_id;
                $shipment->ship_name = $request->ship_name;
                $shipment->voyage_no = $request->voyage_no;
                $shipment->est_arival_date = date('Y-m-d', strtotime($request->est_arival_date));
                $shipment->consignee_id = $request->consignee_id;
                $shipment->tracking_no = $request->tracking_no;
                $shipment->shipping_date = date('Y-m-d', strtotime($request->shipping_date));
                $shipment->updated_by = currentUserId();
                if ($request->has('bill_of_land_1_url')) $shipment->bill_of_land_1_url = $this->uploadImage($request->file('bill_of_land_1_url'), 'uploads/bill_of_land_1_url');
                if ($request->has('bill_of_land_2_url')) $shipment->bill_of_land_2_url = $this->uploadImage($request->file('bill_of_land_2_url'), 'uploads/bill_of_land_2_url');
                if ($request->has('exp_can_cer_url_1')) $shipment->exp_can_cer_url_1 = $this->uploadImage($request->file('exp_can_cer_url_1'), 'uploads/exp_can_cer_url_1');
                if ($request->has('exp_can_cer_url_2')) $shipment->exp_can_cer_url_2 = $this->uploadImage($request->file('exp_can_cer_url_2'), 'uploads/exp_can_cer_url_2');
                $shipment->executiveId = currentUserId();
                $shipment->created_by = currentUserId();
                if ($shipment->save())
                    return redirect()->route(currentUser() . '.client_individual', encryptor('encrypt', $request->client_id))->with(Toastr::success('Shipment Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\ShipmentDetail  $shipmentDetail
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $resrv = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->select('reserved_vehicles.*', 'vehicles.fullName', 'vehicles.stock_id', 'vehicles.id as vid')
            ->where('reserved_vehicles.id', encryptor('decrypt', $id))->first();
        $user = User::where('id', $resrv->user_id)->first();
        $countries = Country::all();
        $ports = Port::all();
        $consignee = ConsigneeDetail::where('user_id', $resrv->user_id)->get();
        //print_r($user);die;
        return view('sales_module.shipment.show', compact('resrv', 'user', 'countries', 'consignee', 'ports'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ShipmentDetail  $shipmentDetail
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $shipment = ShipmentDetail::find(encryptor('decrypt', $id));
        $user = User::where('id', $shipment->client_id)->first();
        $countries = Country::all();
        $ports = Port::all();
        $consignee = ConsigneeDetail::where('user_id', $shipment->client_id)->get();
        
        $resrv = DB::table('reserved_vehicles')
            ->join('vehicles', 'vehicles.id', '=', 'reserved_vehicles.vehicle_id')
            ->select('reserved_vehicles.*', 'vehicles.fullName', 'vehicles.stock_id', 'vehicles.id as vid')
            ->where('reserved_vehicles.id', encryptor('decrypt', $id))->first();
        return view('sales_module.shipment.edit', compact('shipment', 'resrv', 'user', 'countries', 'consignee', 'ports'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ShipmentDetail  $shipmentDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $shipment = ShipmentDetail::find(encryptor('decrypt', $id));
            $shipment->auc_country_id = $request->auc_country_id;
            $shipment->des_country_id = $request->des_country_id;
            $shipment->ins_req_date = date('Y-m-d', strtotime($request->ins_req_date));
            $shipment->ins_pass_date = date('Y-m-d', strtotime($request->ins_pass_date));
            $shipment->dep_port_id = $request->dep_port_id;
            $shipment->des_port_id = $request->des_port_id;
            $shipment->ship_name = $request->ship_name;
            $shipment->voyage_no = $request->voyage_no;
            $shipment->est_arival_date = date('Y-m-d', strtotime($request->est_arival_date));
            $shipment->consignee_id = $request->consignee_id;
            $shipment->tracking_no = $request->tracking_no;
            $shipment->shipping_date = date('Y-m-d', strtotime($request->shipping_date));
            $shipment->updated_by = currentUserId();
            if ($request->has('bill_of_land_1_url')) $shipment->bill_of_land_1_url = $this->uploadImage($request->file('bill_of_land_1_url'), 'uploads/bill_of_land_1_url');
            if ($request->has('bill_of_land_2_url')) $shipment->bill_of_land_2_url = $this->uploadImage($request->file('bill_of_land_2_url'), 'uploads/bill_of_land_2_url');
            if ($request->has('exp_can_cer_url_1')) $shipment->exp_can_cer_url_1 = $this->uploadImage($request->file('exp_can_cer_url_1'), 'uploads/exp_can_cer_url_1');
            if ($request->has('exp_can_cer_url_2')) $shipment->exp_can_cer_url_2 = $this->uploadImage($request->file('exp_can_cer_url_2'), 'uploads/exp_can_cer_url_2');
            $shipment->executiveId = currentUserId();
            $shipment->updated_by = currentUserId();
            if ($shipment->save()) {
                return redirect()->route(currentUser() . '.client_individual', encryptor('encrypt', $shipment->client_id))->with(Toastr::success('Shipment Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\ShipmentDetail  $shipmentDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ShipmentDetail $shipmentDetail)
    {
        //
    }
}
