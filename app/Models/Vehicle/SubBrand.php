<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubBrand extends Model
{
    use HasFactory;
    public function getRouteKeyName()
    {
        return 'slug_name';
    }
    public function brand(){
        return $this->belongsTo(Brand::class);
    }
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
    public function getSlugAttribute()
    {
        return \Illuminate\Support\Str::slug($this->slug_name);
    } 
}
