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
        Schema::table('favourite_vehicles', function (Blueprint $table) {
            $table->integer('vehicle_id')->after('id');
            $table->integer('user_id')->after('vehicle_id');
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
        Schema::table('favourite_vehicles', function (Blueprint $table) {
            $table->dropColumn('vehicle_id');
            $table->dropColumn('user_id');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
        });
    }
};
