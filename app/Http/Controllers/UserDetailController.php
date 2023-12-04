<?php

namespace App\Http\Controllers;


use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;
use App\Http\Requests\UserDetails\UpdateRequest;
use Exception;
use Toastr;

class UserDetailController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function show(UserDetail $userDetail)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDetail $userDetail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try {
            $user = User::findOrFail(encryptor('decrypt',$id));
            $user->contact_no =  trim($request->firstName).' '.trim($request->lastName);
            $user->save();

            $userdetl=UserDetail::where('user_id',encryptor('decrypt',$id))->first();
            //print_r($userdetl->toArray());die;
            $userdetl->wife_husband_name=$request->wife_husband_name;
            $userdetl->father_name=$request->father_name;
            $userdetl->mother_name=$request->mother_name;
            $userdetl->address1=$request->address1;
            $userdetl->address2=$request->address2;
            /*$userdetl->city=$request->city;
            $userdetl->state=$request->state;
            $userdetl->zip=$request->zip;*/
            $userdetl->whatsapp=$request->whatsapp;
            $userdetl->facebook=$request->facebook;
            $userdetl->viver=$request->viver;
            $userdetl->instagram=$request->instagram;
            $userdetl->gmail=$request->gmail;
            $userdetl->contact_no=$request->contact_no;
            if ( $userdetl->save()) {
                return redirect()->back()->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            } else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
            dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
              
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDetail  $userDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDetail $userDetail)
    {
        //
    }
}
