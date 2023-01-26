<?php

namespace App\Models\Settings;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;
    
    public function unitstyle(){
        return $this->belongsTo(UnitStyle::class,'unit_style_id','id');
    }
}
