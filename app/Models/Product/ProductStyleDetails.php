<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\UnitStyle;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductStyleDetails extends Model
{
    use HasFactory,SoftDeletes;
    
    public function product(){
        return $this->belongsTo(Product::class);
    }
    public function unitstyle(){
        return $this->belongsTo(UnitStyle::class,'unit_style_id','id');
    }
}
