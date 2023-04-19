<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle\Vehicle;
use App\Models\Settings\Port;
class Invoice extends Model
{
    use HasFactory;
    public function vehicle(){
        return $this->hasOne(Vehicle::class,'id','vehicle_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','customer_id');
    }
    public function res_vehicle(){
        return $this->hasOne(ReservedVehicle::class,'id','reserve_id');
    }
    public function dep_port(){
        return $this->hasOne(Port::class,'id','dep_port_id');
    }
    public function des_port(){
        return $this->hasOne(Port::class,'id','des_port_id');
    }
    public function consignee(){
        return $this->hasOne(ConsigneeDetail::class,'id','consignee_id');
    }
}
