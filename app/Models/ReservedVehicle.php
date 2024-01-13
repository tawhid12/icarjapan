<?php

namespace App\Models;
use Illuminate\Support\Facades\Log;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vehicle\Vehicle;
class ReservedVehicle extends Model
{
    use HasFactory;
    public function res_user(){
        return $this->hasOne(User::class,'id','user_id');
    }
    public function assign_user(){
        return $this->hasOne(User::class,'id','assign_user_id');
    }
    public function vehicle(){
        return $this->hasOne(Vehicle::class,'id','vehicle_id');
    }
    protected $fillable = ['total']; // Make sure 'total' is fillable
    public function total()
    {
        $sum = $this->fob_amt + ($this->m3_value*$this->m3_charge) + $this->aditional_cost + $this->freight_amt + $this->insu_amt + $this->insp_amt;
        Log::info("FoB: = {$this->fob_amt}");
        Log::info("Discount: = {$this->discount}");
        Log::info("Discount: = {($this->m3_value*$this->m3_charge) + $this->aditional_cost + $this->freight_amt + $this->insu_amt + $this->insp_amt}");
        if($this->discount > 0){
            $sum -=  $this->discount;
        }
        // If the decimal part is greater than or equal to 0.5, round up; otherwise, round down
        $sum = ($sum - floor($sum) >= 0.5) ? ceil($sum) : floor($sum);
        $this->total = $sum;
        //dd($this->total); 
        // Check if $sum is calculated correctly
        Log::info("Debugging: total = {$this->total}");
        $this->save();
    }
}
