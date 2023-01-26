<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;
use App\Models\Product\Indent;
use App\Models\Company\Company;

class Requisition extends Model
{
    use HasFactory;
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function indent(){
        return $this->belongsTo(Indent::class);
    }
    public function productstyle(){
        return $this->belongsTo(Product::class,'product_style_id','id');
    }
    public function details(){
        return $this->hasMany(RequisitionDetails::class,'requisition_id','id');
    }
}
