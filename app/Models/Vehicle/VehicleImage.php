<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleImage extends Model
{
    use HasFactory;
    public function images()
    {
        return $this->hasMany(VehicleImage::class);
    }   
}
