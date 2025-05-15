<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\User;
use App\Http\Requests\AdminUser\AddNewRequest;
use App\Http\Requests\AdminUser\UpdateRequest;
use Illuminate\Support\Facades\Hash;
use App\Http\Traits\ImageHandleTraits;
use App\Models\UserDetail;
use App\Models\Settings\Country;
use Carbon\Carbon;
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
    public function index(Request $request)
    {
        $roles = Role::all();
        $countries = Country::all();
        $order_by = 'desc';
        if (currentUser() == 'salesexecutive') {
            $users = User::with('country')->where('created_by', currentUserId())->paginate(50);
        } else {
            //$users = User::with(['country','role'])->where('role_id', 3)->orderBy('id','desc')->paginate(50);
            $users = User::with(['country','role']);
            if ($request->search) {
                $users = $users->where(function($query) use ($request){
                    $query->where('name', 'like', '%' . $request->search . '%')
                            ->orWhere('email', 'like', '%' . $request->search . '%');
                });
                
            } elseif ($request->country_id) {
                $users = $users->where('country_id', $request->country_id);
            }elseif ($request->role_id) {
                $users = $users->where('role_id', $request->role_id);
            }elseif ($request->order_by) {
                $order_by = $request->order_by;
            }
            $users = $users->orderBy('id',$order_by)->paginate(50);
            $users = $users->appends(
                [
                    'search' => $request->search,
                    'country_id' => $request->country_id,
                    'role_id' => $request->role_id,
                ]
            );
        }
        return view('settings.adminusers.index', compact('users', 'roles', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $role = Role::all();
        return view('settings.adminusers.create', compact('role'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddNewRequest $request)
    {
        try {
            $user = new User;
            $user->name = $request->userName;
            $user->contact_no = $request->contactNumber;
            $user->email = $request->userEmail;
            if (currentUser() == 'salesexecutive') {
                $user->role_id = 4;
            } else {
                $user->role_id = $request->role_id;
            }
            $user->executiveId = currentUser();
            $user->password = Hash::make($request->password);
            $user->all_company_access = $request->all_company_access;
            if (currentUser() == 'salesexecutive' || currentUser() == 'superadmin')
                $user->created_by = currentUserId();

            if ($request->has('image')) $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');

            if ($user->save()) {
                UserDetail::insert(['user_id' => $user->id, 'created_at' => Carbon::now()]);
                return redirect()->route(currentUser() . '.admin.index')->with(Toastr::success('Data Saved!', 'Success', ["positionClass" => "toast-top-right"]));
            } else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
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
        $role = Role::all();
        $user = User::findOrFail(encryptor('decrypt', $id));
        return view('settings.adminusers.edit', compact('user', 'role'));
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
        try {
            $user = User::findOrFail(encryptor('decrypt', $id));

            $user->name = $request->userName;
            $user->contact_no = $request->contactNumber;
            $user->role_id = $request->role_id;
            $user->status = $request->status;
            $user->all_company_access = $request->all_company_access;


            if ($request->has('image'))
                if ($this->deleteImage($user->image, 'uploads/admin'))
                    $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');
                else
                    $user->image = $this->uploadImage($request->file('image'), 'uploads/admin');

            if ($request->has('password') && $request->password)
                $user->password = Hash::make($request->password);

            if ($user->save())
                return redirect()->route(currentUser() . '.admin.index')->with(Toastr::success('Successfully updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
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
        try {
            $user = User::findOrFail(encryptor('decrypt', $id));
            if ($user->delete())
                return redirect()->back()->with(Toastr::success('Successfully deleted!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
    public function cm_category(Request $request, $id)
    {
        try {
            $user = User::findOrFail(encryptor('decrypt', $id));
            $user->cm_category = $request->cm_category;
            $user->port_id = $request->port_id;

            if ($user->save())
                return redirect()->back()->with(Toastr::success('Successfully updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }
    public function cm_type(Request $request, $id)
    {
        try {
            $user = User::findOrFail(encryptor('decrypt', $id));
            $user->cmType = $request->cm_type;
            if ($user->save())
                return redirect()->back()->with(Toastr::success('Successfully updated!', 'Success', ["positionClass" => "toast-top-right"]));
            else
                return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        } catch (Exception $e) {
            //dd($e);
            return redirect()->back()->withInput()->with(Toastr::error('Please try again!', 'Fail', ["positionClass" => "toast-top-right"]));
        }
    }

    public function secretLogin($id)
    {
        request()->session()->flush();
        try {
            $user = User::find($id);
            if ($user) {
                $this->setSession($user);
                if (currentUser() == 'user') {
                    return redirect()->route('front')->with(Toastr::success('Successfully Login!', 'Success', ["positionClass" => "toast-top-right"]));
                } else {
                    return redirect()->route($user->role->identity . '.dashboard')->with(Toastr::success('Successfully Login!', 'Success', ["positionClass" => "toast-top-right"]));
                }
            }
        } catch (Exception $e) {
            //dd($e);
            return redirect()->route('login')->with(Toastr::success('Invaid!', 'Success', ["positionClass" => "toast-top-right"]));
        }
    }

    protected function setSession($user)
    {
        return request()->session()->put(
            [
                'userId' => encryptor('encrypt', $user->id),
                'userName' => encryptor('encrypt', $user->name),
                'role' => encryptor('encrypt', $user->role->type),
                'roleIdentity' => encryptor('encrypt', $user->role->identity),
                'country_id' => $user->country_id,
                /*'language'=>encryptor('encrypt',$user->language),
                'companyId'=>encryptor('encrypt',$user->company_id),*/
                'companyAccess' => encryptor('encrypt', $user->all_company_access),
                'image' => $user->image ? $user->image : 'no-image.png'
            ]
        );
    }
}
