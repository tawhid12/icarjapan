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
        Schema::create('vehicle_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vehicle_id')->index()->foreign('vehicle_id')->references('id')->on('vehicle_images')->onDelete('cascade');
            $table->tinyInteger('is_cover_img')->nullable();
            $table->tinyInteger('is_360_int')->comment('360 Interiror Image')->nullable();
            $table->tinyInteger('is_360_ext')->comment('360 Exterior Image')->nullable();
            $table->string('image');
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
        Schema::dropIfExists('vehicle_images');
    }
};
