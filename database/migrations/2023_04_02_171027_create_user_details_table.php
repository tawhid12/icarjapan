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
        Schema::create('user_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->string('wife_husband_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('whatsapp')->unique()->nullable();
            $table->string('facebook')->unique()->nullable();
            $table->string('viver')->unique()->nullable();
            $table->string('instagram')->unique()->nullable();
            $table->string('gmail')->unique()->nullable();
            $table->string('contact_no')->unique()->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->integer('division_id')->nullable();
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
        Schema::dropIfExists('user_details');
    }
};
