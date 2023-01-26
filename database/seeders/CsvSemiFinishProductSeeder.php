<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product\SemiFinishProduct;
use Carbon\Carbon;

class CsvSemiFinishProductSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`category_id`, `item_code`, `name`, `item_type`, `unit_price`, `description`, `unit_style_id`, `status`,
     * @return void
     */
    public function run()
    {
        SemiFinishProduct::truncate();
  
        $csvFile = fopen(base_path("database/data/semifinishproduct.csv"), "r");
  
        $product = array();
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            SemiFinishProduct::create(array(
                "category_id" => trim($data['0']),
                "item_code" => trim($data['1']),
                "name" => utf8_encode(trim($data['2'])),
                "item_type" => trim($data['3']),
                "unit_price" => "0",
                "description" => "",
                "color" => "",
                "unit_style_id" => trim($data['4']),
                "status" => 1,
                "created_by"=>1,
                "created_at"=>Carbon::now()
            ));
        }
   
        fclose($csvFile);
    }
}
