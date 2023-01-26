<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product\Product;
use Carbon\Carbon;

class ProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`category_id`, `item_code`, `name`, `item_type`, `unit_price`, `description`, `unit_style_id`, `status`,
     * @return void
     */
    public function run()
    {
        Product::create([
            "category_id" => 1,
            "item_code" => "0001",
            "name" => "Zipper",
            "item_type" => 1,
            "unit_price" => "0",
            "description" => "Test",
            "unit_style_id" => 1,
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
