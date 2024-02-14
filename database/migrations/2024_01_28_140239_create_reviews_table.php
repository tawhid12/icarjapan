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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_id')->nullable();
            $table->integer('vehicle_id')->nullable();
            $table->integer('client_id');
            $table->unsignedTinyInteger('rating');
            //$table->string('upload');
            $table->text('comment');
            $table->text('reply');
            $table->tinyInteger('review_type')->default(1)->comment('1 => For purchased , 2 => Company Review 3=> 3=> vehicle Review');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reviews');
    }
};
