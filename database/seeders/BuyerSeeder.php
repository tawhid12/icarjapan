<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Buyer;
use Carbon\Carbon;

class BuyerSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`name`, `contact`, `email`, `country`, `city`, `address`, `location`, `status`
     * @return void
     */
    public function run()
    {
        Buyer::create([
            "name" => "Buyer 1",
            "contact" => "01000000000",
            "email" => "admin@email.com",
            "country" => "UK",
            "city" => "London",
            "address" => "Sector 7, London",
            "location" => "CEPZ",
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
