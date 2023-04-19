<?php

namespace App\Http\Controllers;

use App\Models\Buy;
use App\Models\Notification;
use Illuminate\Http\Request;
use Toastr;
class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $all_buy = Buy::all();
        return view('settings.buy.index',compact('all_buy'));
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function show(Buy $buy)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function edit(Buy $buy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Buy $buy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Buy  $buy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buy $buy)
    {
        //
    }
}
