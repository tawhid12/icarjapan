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
        Schema::create('deposits', function (Blueprint $table) {
            $table->id();
            $table->integer('client_id');
            $table->tinyInteger('deposit_type')->comment('1 => Regular , 2=> Others')->default(1);
            $table->decimal('deposit_amt',10,2)->nullable();
            $table->date('deposit_date')->nullable();
            $table->integer('deposit_by')->nullable();
            $table->decimal('deduction',10,2)->nullable();
            $table->date('merge_date')->nullable();
            $table->integer('merged_by')->nullable();
            $table->integer('payment_id')->nullable();
            $table->string('deposit_note')->nullable();
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
        Schema::dropIfExists('deposits');
    }
};
