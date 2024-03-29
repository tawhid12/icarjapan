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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->integer('invoice_id')->nullable();
            $table->integer('reserve_id')->nullable();
            $table->date('receive_date')->nullable();
            $table->integer('currency_type')->nullable();
            $table->decimal('amount',10,2)->nullable();
            $table->tinyInteger('type')->comment('1 => Regular, 2=> Merge from Deposit')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('paid_by')->nullable();
            $table->string('payment_note')->nullable();
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
        Schema::dropIfExists('payments');
    }
};
