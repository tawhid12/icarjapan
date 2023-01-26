<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Unit;
use Carbon\Carbon;

class UnitSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Unit::create([
            "unit_style_id" => "1",
            "name" => "PCS",
            "qty" => 1,
            "status" => 1,
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
