<?php

namespace App\Http\Controllers;

use App\Models\CompanyAccountInfo;
use Illuminate\Http\Request;
use Toastr;
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
        $com_acc_info = CompanyAccountInfo::first();
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
    public function update(Request $request, $id)
    {
        try{
            $cinfo=CompanyAccountInfo::findOrFail(encryptor('decrypt',$id));
            $cinfo->c_name=$request->c_name;
            $cinfo->c_address=$request->c_address;
            $cinfo->bank_name=$request->bank_name;
            $cinfo->account_name=$request->account_name;
            $cinfo->branch_name=$request->branch_name;
            $cinfo->account_number=$request->account_number;
            $cinfo->swift_code=$request->swift_code;
            $cinfo->bank_address=$request->bank_address;
            $cinfo->bank_code=$request->bank_code;
            $cinfo->beni_name=$request->beni_name;
            $cinfo->tel=$request->tel;
            $cinfo->fax=$request->fax;
            $cinfo->whatsup=$request->whatsup;
            $cinfo->email=$request->email;
            $cinfo->website=$request->website;
            $cinfo->reserve_cancel=$request->reserve_cancel;
            if($cinfo->save())
                return redirect()->route(currentUser().'.compaccinfo.create')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
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
