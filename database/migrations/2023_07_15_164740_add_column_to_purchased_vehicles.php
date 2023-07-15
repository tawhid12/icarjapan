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
        Schema::table('purchased_vehicles', function (Blueprint $table) {
            $table->integer('vehicle_id')->after('id');
            $table->integer('reserve_id')->after('vehicle_id');
            $table->integer('invoice_id')->after('reserve_id');
            $table->integer('executive_id')->after('invoice_id');
            $table->integer('customer_id')->after('executive_id');
            $table->date('sale_date')->nullable()->after('customer_id');
            $table->tinyInteger('status')->default(0)->comment('1 for handover out 0 for pending')->after('customer_id');
            $table->unsignedBigInteger('created_by')->index()->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable()->index()->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchased_vehicles', function (Blueprint $table) {
            $table->dropColumn('vehicle_id');
            $table->dropColumn('reserve_id');
            $table->dropColumn('invoice_id');
            $table->dropColumn('executive_id');
            $table->dropColumn('customer_id');
            $table->dropColumn('sale_date');
            $table->dropColumn('status');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
