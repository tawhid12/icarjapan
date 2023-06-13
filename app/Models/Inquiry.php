<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\Country;
class Inquiry extends Model
{
    use HasFactory;
    public function country(){
        return $this->hasOne(Country::class,'id','country_id');
    }
    public function user(){
        return $this->hasOne(User::class,'id','replied_by');
    }
}
