<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseBoard extends Model
{
    use HasFactory;
    public function warehouse(){
        return $this->belongsTo(Warehouse::class);
    }
}
