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
        Schema::create('consignee_details', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('c_name')->nullable();
            $table->string('c_country_id')->comment('Notify Name')->nullable();
            $table->string('c_state')->nullable();
            $table->string('c_city')->nullable();
            $table->string('c_address')->nullable();
            $table->string('c_ref_address')->comment('Consignee Reference Address')->nullable();
            $table->string('c_phone')->nullable();
            $table->string('c_email')->nullable();

            $table->string('n_name')->nullable();
            $table->string('n_country_id')->comment('Notify Name')->nullable();
            $table->string('n_state')->nullable();
            $table->string('n_city')->nullable();
            $table->string('n_address')->nullable();
            $table->string('n_ref_address')->comment('Consignee Reference Address')->nullable();
            $table->string('n_phone')->nullable();
            $table->string('n_email')->nullable();

            $table->tinyInteger('notify_same_as_con')->comment('Notify Same as Consignee')->default(0)->nullable();
            $table->tinyInteger('per_con')->comment('permanent consignee')->default(0)->nullable();
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
        Schema::dropIfExists('consignee_details');
    }
};
