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
        Schema::create('countries_vehicles', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id')->index()->foreign('country_id')->references('id')->on('countries')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('vehicle_id')->index()->foreign('vehicle_id')->references('id')->on('vehicles')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('created_by')->index()->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable()->index()->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries_vehicles');
    }
};
