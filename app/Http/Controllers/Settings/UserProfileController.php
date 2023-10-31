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
use DB;
use Toastr;
use Illuminate\Support\Carbon;
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
            countryIp();
            $location =  request()->session()->get('location');
            $countryName =  request()->session()->get('countryName');
            if (isset($location['geoplugin_currencyCode']) && isset($location['geoplugin_currencyConverter']) && isset($countryName->id)) {
                return view('settings.user.profile',compact('user','countries','ports','com_info'));
            }
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
        if(currentUser() == 'user')
        return view('settings.user.change_password');
        else
        return view('settings.general.change_password');
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


        /*Student Transfer */
        public function clientTransfer()
        {
            $allUser = User::where('role_id',4)->get();
            return view('client.clientTransfer', compact('allUser'));
        }
        public function clientExecutive(Request $request)
        {
            $old_ex = User::where('id',$request->id)->first();
            
            $ex_list = User::where('role_id',3)->whereNot('id','=',$old_ex->executiveId)->get();
      
            $old_ex_data = User::find($old_ex->executiveId);
            /*echo '<pre>';
            print_r($old_ex_data->toArray());die;*/
            $data = '
            <label for="curexId" class="col-sm-3">Old Executive</label>
            <div class="col-sm-9">
            <input type="text" class="form-control" value="'.$old_ex_data->name.'" readonly>
            <input type="hidden" class="form-control" value="'.$old_ex_data->id.'" name="curexId">
            </div>
        ';
            //return response()->json(array('data' => $ex_list));
            $data2 = '<label for="newexId" class="col-sm-3">To Executive</label>
                <div class="col-sm-9">
                <select class="js-example-basic-single form-control" id="newexId" name="newexId" required>
                <option value="">Select</option>';
            foreach ($ex_list as $e) {
                $data2 .= '<option value="' . $e->id . '">' . $e->name . '</option>';
            }
            $data2 .= '</select></div>';
    
    
            return response()->json(array('data' => $data,'data2' =>$data2));
        }
        public function clTransfer(Request $request)
        {
            DB::beginTransaction();
    
            try {
                /*== Check Client Has Reservation Exists== */
                get_cancel_date();
                $data = array(
                    'executiveId' => $request->newexId
                );

                DB::table('users')->where('id',$request->user_id)->update($data);
                $data2 = array(
                    'user_id' => $request->user_id,
                    'curexId' => $request->curexId,
                    'newexId' =>  $request->newexId,
                    'created_by' => currentUserId(),
                    'note' => $request->note,
                    'created_at' => Carbon::now()
                );
                DB::table('client_transfers')->insert($data2);
                DB::commit();
                return redirect()->route(currentUser().'.clientTransferList')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            } catch (\Exception $e) {
                DB::rollback();
                // something went wrong
                dd($e);
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
                return false;
            }
        }
        public function clientTransferList(){
            $client_transfers = DB::table('client_transfers')
            ->join('users','client_transfers.created_by','users.id')
            ->select('client_transfers.*','users.name as uname')
            ->get();
            return view('client.clientTransferList',compact('client_transfers'));
        }
        public function assignTo(Request $request){
            $user = User::where('id',$request->user_id)->first();
            if(!$user->executiveId){
                User::where('id',$request->user_id)->update(['executiveId' => currentUserId()]);
                return redirect()->back()->with(Toastr::success('Assigned to successful!', 'Success', ["positionClass" => "toast-top-right"]));
            }
            else
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
        public function freeUser(Request $request){
            $user = User::where('id',$request->user_id)->first();
            $reserve_count = DB::table('reserved_vehicles')->where('user_id',$request->user_id)->where('status', 1)->count();
            if($user->executiveId && $reserve_count == 0){
                User::where('id',$request->user_id)->update(['executiveId' => null]);
                return redirect()->back()->with(Toastr::success('User Free Successfull!', 'Success', ["positionClass" => "toast-top-right"]));
            }
            else
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }

}