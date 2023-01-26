<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Settings\UnitStyle;
use App\Models\Product\Indent;
use App\Models\Product\Product;
use App\Models\Company\Company;
use App\Models\Company\Warehouse;
use App\Models\Company\WarehouseBoard;
use App\Models\Settings\Supplier;

class ProductInStock extends Model
{
    use HasFactory;
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function warehouse(){
        return $this->belongsTo(Warehouse::class,'warehouse_id','id');
    }
    public function warehouseboard(){
        return $this->belongsTo(WarehouseBoard::class,'warehouse_board_id','id');
    }
    public function supplier(){
        return $this->belongsTo(Supplier::class,'supplier_id','id');
    }
    public function product(){
        return $this->belongsTo(Product::class,'product_id','id');
    }
    public function unitstyle(){
        return $this->belongsTo(UnitStyle::class,'unit_style_id','id');
    }
    public function indent(){
        return $this->belongsTo(Indent::class);
    }
}
