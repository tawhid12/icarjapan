<?php

namespace App\Http\Controllers;

use App\Models\PurchasedVehicle;
use Illuminate\Http\Request;

class PurchasedVehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pur = PurchasedVehicle::where('customer_id', currentUserId())->orderBy('id', 'DESC')->paginate(25);

        $location =  request()->session()->get('location');
        $countryName =  request()->session()->get('countryName');

        if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
            return view('user.pur_vehicle.index', compact('pur', 'location'));
        } else {
            countryIp();
        }
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PurchasedVehicle  $purchasedVehicle
     * @return \Illuminate\Http\Response
     */
    public function show(PurchasedVehicle $purchasedVehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PurchasedVehicle  $purchasedVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(PurchasedVehicle $purchasedVehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PurchasedVehicle  $purchasedVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PurchasedVehicle $purchasedVehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PurchasedVehicle  $purchasedVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(PurchasedVehicle $purchasedVehicle)
    {
        //
    }
}
