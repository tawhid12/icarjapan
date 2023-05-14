<?php

namespace App\Models\Vehicle;
use App\Models\Settings\InventoryLocation;
use App\Models\Settings\BodyType;
use App\Models\Settings\SubBodyType;
use App\Models\Settings\DriveType;
use App\Models\Vehicle\Transmission;

use App\Models\Settings\Country;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    use HasFactory;
    public function vehicle_model(){
        return $this->belongsTo(VehicleModel::class,'v_model_id','id');
    }
    public function countries(){
        return $this->belongsToMany(Country::class,'countries_vehicles','vehicle_id','country_id');
    }
    public function arival_country(){
        return $this->belongsToMany(NewArival::class,'new_arivals','vehicle_id','country_id');
    }
    public function images(){
        return $this->hasOne(VehicleImage::class);
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function sub_brand(){
        return $this->belongsTo(SubBrand::class);
    }
    public function inv_loc(){
        return $this->belongsTo(Country::class,'inv_locatin_id','id');
    }
    public function body_type(){
        return $this->belongsTo(BodyType::class,'body_type_id','id');
    }
    public function sub_body_type(){
        return $this->belongsTo(SubBodyType::class,'sub_body_type_id','id');
    }
    public function drive_type(){
        return $this->belongsTo(DriveType::class,'drive_id','id');
    }
    public function trans(){
        return $this->belongsTo(Transmission::class,'transmission_id','id');
    }
    public function ext_color(){
        return $this->belongsTo(Color::class,'ext_color_id','id');
    }
    public function int_color(){
        return $this->belongsTo(Color::class,'int_color_id','id');
    }
    public function door(){
        return $this->belongsTo(Door::class,'door_id','id');
    }
    public function seat(){
        return $this->belongsTo(Seat::class,'seat_id','id');
    }
    public function condition(){
        return $this->belongsTo(Condition::class,'con_id','id');
    }
    public function fuel(){
        return $this->belongsTo(Fuel::class,'fuel_id','id');
    }
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
