<?php

namespace App\Http\Controllers\Settings;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Models\Company\Company;
use App\Models\Settings\Department;
use App\Models\Settings\Designation;
use App\Http\Requests\AdminUser\AddNewRequest;
use App\Http\Requests\AdminUser\UpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ImageHandleTraits;
use Exception;
use Toastr;
class AdminUserController extends Controller
{
    use ImageHandleTraits;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        if(companyAccess()){
            $users=User::paginate(10);
        }else{
            $users=User::where(company())->paginate(10);
        }
        
        return view('settings.adminusers.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role=Role::all();
        $department=Department::all();
        $designation=Designation::all();
        $company=Company::all();
        return view('settings.adminusers.create',compact('department','designation','company','role'));
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
            $user=new User;
            $user->name=$request->userName;
            $user->contact_no=$request->contactNumber;
            $user->email=$request->userEmail;
            $user->company_id=$request->company_id;
            $user->department_id=$request->department_id;
            $user->designation_id=$request->designation_id;
            $user->role_id=$request->role_id;
            $user->password=Hash::make($request->password);
            $user->all_company_access=$request->all_company_access;
            $user->show_price=$request->show_price;

            if($request->has('image')) $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');

            if($user->save())
                return redirect()->route(currentUser().'.admin.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role=Role::all();
        $department=Department::all();
        $designation=Designation::all();
        $company=Company::all();
        $user=User::findOrFail(encryptor('decrypt',$id));
        return view('settings.adminusers.edit',compact('user','department','designation','company','role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRequest $request, $id)
    {
        try{
            $user=User::findOrFail(encryptor('decrypt',$id));
            $user->name=$request->userName;
            $user->contact_no=$request->contactNumber;
            $user->email=$request->userEmail;
            $user->company_id=$request->company_id;
            $user->department_id=$request->department_id;
            $user->designation_id=$request->designation_id;
            $user->role_id=$request->role_id;
            $user->status=$request->status;
            $user->all_company_access=$request->all_company_access;
            $user->show_price=$request->show_price;


            if($request->has('image')) 
                if($this->deleteImage($user->image, 'uploads/admin'))
                    $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');
                else
                    $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');

            if($request->has('password') && $request->password)
                $user->password=Hash::make($request->password);
         
            if($user->save())
                return redirect()->route(currentUser().'.admin.index')->with(Toastr::success('Successfully updated!', 'Success', ["positionClass" => "toast-top-right"]));
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $user=User::findOrFail(encryptor('decrypt',$id));
            if($user->delete())
                return redirect()->back()->with(Toastr::success('Successfully deleted!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }catch(Exception $e){
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
        
    }
}
