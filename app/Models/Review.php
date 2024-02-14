<?php

namespace App\Models;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Review extends Model
{
    use HasFactory, SoftDeletes;
    public function review_images(){
        return $this->hasMany(ReviewImage::class);
    }
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class,'vehicle_id','id');
    }
    public function user()
    {
        return $this->belongsTo(User::class,'client_id','id');
    }
}
