<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\UnitStyle;
use App\Models\Settings\Buyer;

class Product extends Model
{
    use HasFactory;
    
    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function unitstyle(){
        return $this->belongsTo(UnitStyle::class,'unit_style_id','id');
    }
    public function sfproduct(){
        return $this->belongsTo(Product::class,'semi_finish_product_id','id');
    }
    public function buyer(){
        return $this->belongsTo(Buyer::class,'buyer_id','id');
    }
    
    public function inddetails(){
        return $this->hasMany(IndentDetails::class,'product_id','id');
    }
}
