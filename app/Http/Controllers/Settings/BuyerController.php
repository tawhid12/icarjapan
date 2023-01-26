<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use App\Models\Settings\Buyer;
use Illuminate\Http\Request;
use App\Http\Requests\Settings\Buyer\AddNewRequest;
use App\Http\Requests\Settings\Buyer\UpdateRequest;

use Toastr;

class BuyerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buyers=Buyer::paginate(10);
        return view('settings.buyer.index',compact('buyers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings.buyer.create');
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
            $data=new Buyer;
            $data->buyer_code=$request->buyer_code;
            $data->name=$request->name;
            $data->contact=$request->contact;
            $data->email=$request->email;
            $data->country=$request->country;
            $data->city=$request->city;
            $data->address=$request->address;
            $data->created_by=currentUserId();
            $data->status=1;
            if($data->save())
                return redirect()->route(currentUser().'.buyer.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function show(Buyer $buyer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Settimgs\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $buyer=Buyer::findOrFail(encryptor('decrypt',$id));
        return view('settings.buyer.edit',compact('buyer'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settimgs\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $data=Buyer::findOrFail(encryptor('decrypt',$id));
            $data->buyer_code=$request->buyer_code;
            $data->name=$request->name;
            $data->contact=$request->contact;
            $data->email=$request->email;
            $data->country=$request->country;
            $data->city=$request->city;
            $data->address=$request->address;
            $data->updated_by=currentUserId();
            $data->status=$request->status;
            if($data->save())
                return redirect()->route(currentUser().'.buyer.index')->with(Toastr::success('Data Updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  \App\Models\Settimgs\Buyer  $buyer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Buyer $buyer)
    {
        //
    }
}
