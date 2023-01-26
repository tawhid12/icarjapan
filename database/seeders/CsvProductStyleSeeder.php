<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product\ProductStyle;
use Carbon\Carbon;

class CsvProductStyleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *`name`, `style_code`, `size`, `unit_price`, `description`, `qty`, `buyer_id`, `status`, 
     * @return void
     */
    public function run()
    {
        ProductStyle::truncate();
  
        $csvFile = fopen(base_path("database/data/product_styles.csv"), "r");
  
        $product = array();
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            ProductStyle::create(array(
                "name" =>  utf8_encode(trim($data['0'])),
                "style_code" => trim($data['1']),
                "size" => "",
                "unit_price" => "0.00",
                "description" => "",
                "color" => "",
                "buyer_id" => 1,
                "unit_style_id" => trim($data['2']),
                "status" => 1,
                "created_by"=>1,
                "created_at"=>Carbon::now()
            ));
        }
   
        fclose($csvFile);
    }
}
