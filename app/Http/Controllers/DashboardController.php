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
        $requisitions=Requisition::where(company())->where('status',0)->latest()->paginate(10);
        return view('dasbhoard.superadmin',compact('requisitions'));
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
    public function ownerDashboard(){
        return view('dasbhoard.owner');
    }
    
    /*
    * sales manager dashboard
    */
    public function salesmanagerDashboard(){
        return view('dasbhoard.salesmanager');
    }

    /*
    * sales man dashboard
    */
    public function salesmanDashboard(){
        return view('dasbhoard.salesman');
    }
}
