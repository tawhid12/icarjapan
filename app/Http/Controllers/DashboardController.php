<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Stock\Requisition;

class DashboardController extends Controller
{
    /*
    * admin dashboard
    */
    public function superadminDashboard(){
        return view('dasbhoard.superadmin');
    }
    /*
    * admin dashboard
    */
    public function adminDashboard(){
        return view('dasbhoard.admin');
    }

    /*
    * owner dashboard
    */
    public function userDashboard(){
        return view('dasbhoard.user');
    }
    
    /*
    * sales manager dashboard
    */
    public function salesexecutiveDashboard (){
        return view('dasbhoard.salesexecutive');
    }

    /*
    * sales man dashboard
    */
    public function salesmanDashboard(){
        return view('dasbhoard.salesman');
    }
}
