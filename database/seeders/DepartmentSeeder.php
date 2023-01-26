<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Settings\Department;
use Carbon\Carbon;

class DepartmentSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Department::create([
            "name" => "Store",
            "created_by"=>1,
            "created_at"=>Carbon::now()
        ]);
    }
}
