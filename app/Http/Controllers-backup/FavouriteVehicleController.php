<?php

namespace App\Http\Controllers;

use App\Models\FavouriteVehicle;
use Illuminate\Http\Request;
use Toastr;
class FavouriteVehicleController extends Controller
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
        try{
            $fav = New FavouriteVehicle();
            $fav->vehicle_id = $request->vehicle_id;
            $fav->user_id=currentUserId();
            $fav->status=2;
            $fav->created_by=currentUserId();
            if($fav->save())
            return redirect()->back()->with(Toastr::success('Favourite Added Successfully!', 'Success', ["positionClass" => "toast-top-right"]));;
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FavouriteVehicle  $favouriteVehicle
     * @return \Illuminate\Http\Response
     */
    public function show(FavouriteVehicle $favouriteVehicle)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FavouriteVehicle  $favouriteVehicle
     * @return \Illuminate\Http\Response
     */
    public function edit(FavouriteVehicle $favouriteVehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FavouriteVehicle  $favouriteVehicle
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FavouriteVehicle $favouriteVehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FavouriteVehicle  $favouriteVehicle
     * @return \Illuminate\Http\Response
     */
    public function destroy(FavouriteVehicle $favouriteVehicle)
    {
        //
    }
}
