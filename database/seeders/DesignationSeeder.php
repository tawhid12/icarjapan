<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Designation;
use Carbon\Carbon;

class DesignationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Designation::create([
            "name" => "Store Manager",
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
