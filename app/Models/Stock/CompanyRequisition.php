<?php

namespace App\Models\Stock;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Company\Company;

class CompanyRequisition extends Model
{
    use HasFactory;
    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }
    public function companyTo(){
        return $this->belongsTo(Company::class,'company_id_to','id');
    }
}
