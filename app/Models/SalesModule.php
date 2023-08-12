<?php

namespace App\Models;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesModule extends Model
{
    use HasFactory;
    public function vehicle(){
        return $this->hasOne(Vehicle::class,'vehicle_id','id');
    }
}
