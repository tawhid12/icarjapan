<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('reserved_vehicles', function (Blueprint $table) {
            $table->decimal('fob_amt',10,2)->default(0.00)->after('settle_price');
            $table->decimal('m3_value',10,2)->default(0.00)->after('fob_amt');
            $table->decimal('m3_charge',10,2)->default(0.00)->after('m3_value');
            $table->decimal('aditional_cost',10,2)->default(0.00)->after('m3_charge');
            $table->decimal('freight_amt',10,2)->default(0.00)->after('settle_price')->after('aditional_cost');
            $table->decimal('insu_amt',10,2)->comment('Insurance Amount')->default(0.00)->after('freight_amt');
            $table->decimal('insp_amt',10,2)->comment('Inspect Amount')->default(0.00)->after('insu_amt');
            $table->tinyInteger('shipment_type')->comment('1 => Roro 2=> Container')->nullable()->after('insp_amt');
            $table->decimal('discount')->default(0.00)->after('shipment_type');
            $table->decimal('allocated',10,2)->nullable()->after('discount');
            $table->decimal('total',10,2)->comment('Total Invoice Amount')->nullable()->after('allocated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reserved_vehicles', function (Blueprint $table) {
            $table->dropColumn('fob_amt');
            $table->dropColumn('m3_value');
            $table->dropColumn('m3_charge');
            $table->dropColumn('aditional_cost');
            $table->dropColumn('freight_amt');
            $table->dropColumn('insu_amt');
            $table->dropColumn('insp_amt');
            $table->dropColumn('shipment_type');
            $table->dropColumn('discount');
            $table->dropColumn('allocated');
            $table->dropColumn('total');
        });
    }
};
