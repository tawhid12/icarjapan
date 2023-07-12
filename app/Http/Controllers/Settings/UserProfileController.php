<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings\Country;
use App\Models\Settings\Port;
use App\Models\CompanyAccountInfo;

use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ImageHandleTraits;
use Exception;
use Toastr;

class UserProfileController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function profile()
    {
        $user=User::find(currentUserId());
        $countries=Country::where('id',$user->country_id)->get();
        $ports=Port::where('inv_loc_id',$user->country_id)->get();
        $com_info = CompanyAccountInfo::first();
        if(currentUser() == 'superadmin' || currentUser() == 'salesexecutive'){
            return view('settings.general.profile',compact('user','countries','ports','com_info'));
        }else{
            return view('settings.user.profile',compact('user','countries','ports','com_info'));
        }
        
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
            $user=User::find(currentUserId());
            $user->name=$request->userName;
            $user->contact_no=$request->contactNumber;
            $user->port_id=$request->port_id;
            if($request->has('image')) $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');
            if($user->save())
                return redirect()->back()->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

   
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password()
    {
        return view('settings.user.change_password');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function change_password_store(Request $request)
    {
        try{
            $user=User::find(currentUserId());
            if(Hash::check($request->oldpassword,$user->password)){
                if($request->password==$request->cpassword){
                    if($request->has('password') && $request->password)
                        $user->password=Hash::make($request->password);
                
                    if($user->save())
                        return redirect()->back()->with(Toastr::success('Successfully updated!', 'Success', ["positionClass" => "toast-top-right"]));
                    else
                        return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                }else
                    return redirect()->back()->withInput()->with(Toastr::error('Both the password and confirm password fields value must be matched', 'Fail', ["positionClass" => "toast-top-right"]));
            }else
                return redirect()->back()->withInput()->with(Toastr::error('Old password dose not match!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

}