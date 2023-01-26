<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\UnitStyle;

class IndentDetails extends Model
{
    use HasFactory;
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    
    public function unitstyle(){
        return $this->belongsTo(UnitStyle::class,'unit_style_id','id');
    }
}
