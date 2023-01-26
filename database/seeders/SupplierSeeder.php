<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Supplier;
use Carbon\Carbon;

class SupplierSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`name`, `contact`, `email`, `country`, `city`, `address`, `location`, `status`
     * @return void
     */
    public function run()
    {
        Supplier::create([
            "sup_code" => "sup_01",
            "name" => "Supplier HKD 2",
            "contact" => "01000000000",
            "email" => "admin@email.com",
            "country" => "UK",
            "city" => "London",
            "address" => "Sector 7, London",
            "location" => "0",
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
        Supplier::create([
            "sup_code" => "sup_02",
            "name" => "Supplier HKD",
            "contact" => "01000000000",
            "email" => "admin@email.com",
            "country" => "HK",
            "city" => "Kowloon City",
            "address" => "Sector 7, Kowloon City",
            "location" => "0",
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
        Supplier::create([
            "sup_code" => "sup_03",
            "name" => "KDS",
            "contact" => "01000000000",
            "email" => "kds@email.com",
            "country" => "Bangladesh",
            "city" => "Chattogram",
            "address" => "Sector 7, Chattogram City",
            "location" => "1",
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
