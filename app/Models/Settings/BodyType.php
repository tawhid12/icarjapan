<?php

namespace App\Models\Settings;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle\Vehicle;

class BodyType extends Model
{
    use HasFactory;
    public function vehicles()
    {
        return $this->hasMany(Vehicle::class);
    }
}
