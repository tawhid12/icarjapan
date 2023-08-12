<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Settings\Country;
use Exception;
use Toastr;
class ClientModuleController extends Controller
{
    public function all_client_list(){
        if(currentUser() == 'salesexecutive'){
            $countries = Country::all();
            $users=User::where('created_by',currentUserId())->paginate(50);
            return view('cm_module.cm_module',compact('users','countries'));
        }else{
            $users=User::paginate(10);
            return view('settings.adminusers.index',compact('users'));
        }
    }
    public function client_individual(){
        return view('cm_module.cm_module_individual');
    }
}
