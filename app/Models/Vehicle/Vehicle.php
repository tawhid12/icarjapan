<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    public function vehicle_model(){
        return $this->belongsTo(VehicleModel::class,'v_model_id','id');
    }
}
