<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
use Toastr;
class TestController extends Controller
{
    public function index()
    {
        \Mail::send('mail.reply_body', [], function ($message) {
            $message->from('info@icarjapan.com', 'Icarjapan')
                ->to('tawhid102@gmail.com')/*dev@icarjapan.com*/
                ->subject('Test');
        });
    }
    public function reserve_cancel()
    {
       return true;
        $rsv = DB::table('reserved_vehicles')
            ->join('vehicles', 'reserved_vehicles.vehicle_id', 'vehicles.id')
            ->where('vehicles.r_status', 1)->where('vehicles.sold_status', 0)
            ->select('reserved_vehicles.created_at', 'vehicles.id', 'reserved_vehicles.user_id')
            ->get();
        $cancel_day = (int)\App\Models\CompanyAccountInfo::first()->reserve_cancel;
        foreach ($rsv as $r) {
            if (Carbon::today() > Carbon::parse($r->created_at)) {
                $resv = \App\Models\ReservedVehicle::where('vehicle_id', $r->id)->update(['status' => 3, 'note' => "Reserved Date Exapired!!"]);
                $vehicle = \App\Models\Vehicle\Vehicle::where('id', $r->id)->update(['r_status' => null]);

                $user = \App\Models\User::where('id', $r->user_id)->update(['type' => null]);
            }
        }
    }
}
