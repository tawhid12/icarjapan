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
        Schema::create('reserved_vehicles', function (Blueprint $table) {
            $table->id();
            $table->integer('vehicle_id');
            $table->integer('user_id');
            $table->integer('assign_user_id')->nullable();
            $table->date('confirm_on')->comment('Order Confirm On')->nullable();
            $table->decimal('settle_price',8,2)->comment('vehicle Settle Price')->nullable();
            $table->text('note')->nullable();
            $table->boolean('status')->default(1)->comment('1=>reserved 2=>confirmed');
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
        Schema::dropIfExists('reserved_vehicles');
    }
};
