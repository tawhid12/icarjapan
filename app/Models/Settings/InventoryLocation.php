<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InventoryLocation extends Model
{
    use HasFactory;
    public function country(){
        return $this->belongsTo(Country::class);
    }
}
