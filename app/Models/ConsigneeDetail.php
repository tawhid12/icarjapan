<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Country;

class ConsigneeDetail extends Model
{
    use HasFactory;
    public function country(){
        return $this->hasOne(Country::class,'id','c_country_id');
    }
    public function n_country(){
        return $this->hasOne(Country::class,'id','n_country_id');
    }
}
