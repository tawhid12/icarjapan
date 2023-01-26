<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Unit;
use Carbon\Carbon;

class CsvUnitSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Unit::truncate();
  
        $csvFile = fopen(base_path("database/data/unit.csv"), "r");
  
        $unit = array();
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            Unit::create(array(
                    "unit_style_id" => trim($data['0']),
                    "name" => trim($data['1']),
                    "qty" => trim($data['2']),
                    "status" => 1,
                    "created_by"=>1,
                    "created_at"=>Carbon::now()
                ));
        }
        fclose($csvFile);
    }
}
