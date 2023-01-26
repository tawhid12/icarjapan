<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\UnitStyle;
use Carbon\Carbon;

class CsvUnitStyleSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        UnitStyle::truncate();
  
        $csvFile = fopen(base_path("database/data/unitstyle.csv"), "r");
  
        $ustyle = array();
        while (($data = fgetcsv($csvFile, 2000, ",")) !== FALSE) {
            UnitStyle::create(array(
                "name" => trim($data['0']),
                "status" => 1,
                "created_by"=>1,
                "created_at"=>Carbon::now()
            ));
        }
        
        fclose($csvFile);
    }
}
