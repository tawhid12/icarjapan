<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product\ProductStyle;
use Carbon\Carbon;

class ProductStyleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`name`, `style_code`, `size`, `unit_price`, `description`, `qty`, `buyer_id`, `status`, 
     * @return void
     */
    public function run()
    {
        ProductStyle::create([
            "name" => "FORCASTER SERIES_DECK CHAIR",
            "style_code" => "2176137",
            "size" => "21.25” (W) x 18” (D) x 17”(FH) x 27.25“ (RH)",
            "unit_price" => "0.00",
            "description" => "FABRIC SHOULD BE TRIS/PBDE & OBDE FREE",
            "buyer_id" => 1,
            "unit_style_id" => 1,
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
