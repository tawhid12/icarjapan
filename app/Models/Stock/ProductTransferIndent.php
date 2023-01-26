<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product\Indent;
use App\Models\Company\Company;

class ProductTransferIndent extends Model
{
    use HasFactory;
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function indent(){
        return $this->belongsTo(Indent::class);
    }
    public function indentTo(){
        return $this->belongsTo(Indent::class,'indent_to_id','id');
    }
    
    public function details(){
        return $this->hasMany(ProductTransferIndentDetails::class,'transfer_id','id');
    }
}
