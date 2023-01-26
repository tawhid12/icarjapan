<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company\WarehouseBoard;
use Carbon\Carbon;

class WarehouseBoardSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`warehouse_id`, `board_type`, `board_no`, `capacity`, `location`, `status`, 
     * @return void
     */
    public function run()
    {
        WarehouseBoard::create([
            "warehouse_id" => 1,
            "board_type" => "Large",
            "board_no" => "001",
            "capacity" => "130CFT",
            "location" => "CEPZ",
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
