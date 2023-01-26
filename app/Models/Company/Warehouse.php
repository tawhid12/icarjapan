<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    public function company(){
        return $this->belongsTo(Company::class);
    }
    
}

