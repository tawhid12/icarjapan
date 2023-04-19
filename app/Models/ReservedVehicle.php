<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle\Vehicle;
class ReservedVehicle extends Model
{
    use HasFactory;
    public function res_user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function assign_user(){
        return $this->hasOne(User::class,'id','assign_user_id');
    }
    public function vehicle(){
        return $this->hasOne(Vehicle::class,'id','vehicle_id');
    }
}
