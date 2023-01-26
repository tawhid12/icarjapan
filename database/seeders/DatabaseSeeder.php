<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            WarehouseSeeder::class,
            WarehouseBoardSeeder::class,
            UnitStyleSeeder::class,
            UnitSeeder::class,
            BuyerSeeder::class,
            SupplierSeeder::class,
            DepartmentSeeder::class,
            DesignationSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            //ProductStyleSeeder::class,
            //CsvProductStyleSeeder::class,
            CsvUnitSeeder::class,
            CsvUnitStyleSeeder::class,
            CsvProductSeeder::class,
            //CsvSemiFinishProductSeeder::class,
            IndentSeeder::class,
        ]);
    }
}
