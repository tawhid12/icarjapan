<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Product;

class RequisitionDetails extends Model
{
    use HasFactory;
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
}
