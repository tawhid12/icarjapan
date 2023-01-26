<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company\Warehouse;
use Carbon\Carbon;

class WarehouseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            "company_id" => 1,
            "name" => "warehouse 1",
            "contact" => "01000000000",
            "email" => "admin@email.com",
            "address" => "Sector 7, CEPZ",
            "location" => "CEPZ",
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
