<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'name';
    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
    public function sub_brand()
    {
        return $this->hasMany(SubBrand::class)->orderBy('name');
    }
    public function getSlugAttribute()
    {
        return \Illuminate\Support\Str::slug($this->name);
    } 
    public function breadcrumbName(){
        return $this->name;
    }    
}
