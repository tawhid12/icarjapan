<?php

namespace App\Http\Controllers;

use App\Models\MostView;
use Illuminate\Http\Request;

class MostViewController extends Controller
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
        if(MostView::where('vehicle_id',$request->vehicle_id)->where('country_id',$request->country_id)->exists()){
            $vehicle = MostView::where('vehicle_id',$request->vehicle_id)->where('country_id',$request->country_id)->first();
            $most_view = MostView::find($vehicle->id);
            $most_view->increment('view_count');
        }else{
            $most_view = New MostView();
            $most_view->country_id = $request->country_id;
            $most_view->vehicle_id = $request->vehicle_id;
            $most_view->view_count = 1;
            $most_view->save();
        }

        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\MostView  $mostView
     * @return \Illuminate\Http\Response
     */
    public function show(MostView $mostView)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\MostView  $mostView
     * @return \Illuminate\Http\Response
     */
    public function edit(MostView $mostView)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\MostView  $mostView
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, MostView $mostView)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\MostView  $mostView
     * @return \Illuminate\Http\Response
     */
    public function destroy(MostView $mostView)
    {
        //
    }
}
