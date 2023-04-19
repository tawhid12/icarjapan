<?php

namespace App\Http\Controllers;

use App\Models\CompanyAccountInfo;
use Illuminate\Http\Request;

class CompanyAccountInfoController extends Controller
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
        $com_acc_info = CompanyAccountInfo::all();
        return view('settings.company.com_info',compact('com_acc_info'));
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
     * @param  \App\Models\CompanyAccountInfo  $companyAccountInfo
     * @return \Illuminate\Http\Response
     */
    public function show(CompanyAccountInfo $companyAccountInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CompanyAccountInfo  $companyAccountInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(CompanyAccountInfo $companyAccountInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CompanyAccountInfo  $companyAccountInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CompanyAccountInfo $companyAccountInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CompanyAccountInfo  $companyAccountInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(CompanyAccountInfo $companyAccountInfo)
    {
        //
    }
}
