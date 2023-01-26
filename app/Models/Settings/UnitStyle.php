<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UnitStyle extends Model
{
    use HasFactory;

    public function unit(){
        return $this->hasMany(Unit::class);
    }
}
