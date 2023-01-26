<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product\Indent;
use Carbon\Carbon;

class IndentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`name`, `style_code`, `size`, `unit_price`, `cstmr`, `description`, `qty`, `buyer_id`, `status`, 
     * @return void
     */
    public function run()
    {
        Indent::create([
            "product_style_id" => "4386",
            "unit_style_id" => "1",
            "indent_no" => "ID23-0511 (305)",
            "qty" => "550.00",
            "weight" => "0.00",
            "unit_price" => "17.76",
            "order_date" => Carbon::now()->format('Y-m-d'),
            "start_date" => Carbon::now()->format('Y-m-d'),
            "finish_date" => Carbon::now()->format('Y-m-d'),
            "actual_finish_date" => Carbon::now()->format('Y-m-d'),
            "description" => "FABRIC SHOULD BE TRIS/PBDE & OBDE FREE Pl's Follow Coleman Chair Protocol materials must be Phthalates and Lead free",
            "buyer_id" => 1,
            "company_id" => 1,
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
