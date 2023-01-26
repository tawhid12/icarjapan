<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\UnitStyle;
use App\Models\Settings\Buyer;
use App\Models\Company\Company;

class Indent extends Model
{
    use HasFactory;
    
    public function productstyle(){
        return $this->belongsTo(Product::class,'product_style_id','id');
    }
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function unitstyle(){
        return $this->belongsTo(UnitStyle::class,'unit_style_id','id');
    }
    public function buyer(){
        return $this->belongsTo(Buyer::class);
    }
    public function details(){
        return $this->hasMany(IndentDetails::class,'indent_id','id');
    }
}
