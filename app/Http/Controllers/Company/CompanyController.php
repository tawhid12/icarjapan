<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller;

use App\Models\Company\Company;
use Illuminate\Http\Request;
use App\Http\Requests\Company\Company\AddNewRequest;
use App\Http\Requests\Company\Company\UpdateRequest;
use Toastr;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies=Company::all();
        return view('company.company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('company.company.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
        try{
            $company=new Company;
            $company->name=$request->name;
            $company->contact=$request->contact;
            $company->email=$request->email;
            $company->address=$request->address;
            $company->location=$request->location;
            $company->created_by=currentUserId();
            $company->status=1;
            if($company->save())
                return redirect()->route(currentUser().'.company.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $company=Company::findOrFail(encryptor('decrypt',$id));
        return view('company.company.edit',compact('company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $company=Company::findOrFail(encryptor('decrypt',$id));
            $company->name=$request->name;
            $company->contact=$request->contact;
            $company->email=$request->email;
            $company->address=$request->address;
            $company->location=$request->location;
            $company->updated_by=currentUserId();
            $company->status=$request->status;
            if($company->save())
                return redirect()->route(currentUser().'.company.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        //
    }
}
