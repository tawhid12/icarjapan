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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            /*Car And Reserved Vehice Detials */
            $table->tinyInteger('invoice_type')->comment('1 => Profoma invoice, 2 => Deposit invoice, 3 => Balance invoice, 4 => Final invoice, 5 => Caricom invoice')->nullable();
            $table->integer('reserve_id')->nullable();
            $table->integer('vehicle_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('executiveId')->nullable();
            $table->date('invoice_date')->nullable();


            /*Pricing Details */
           
            $table->decimal('van_amt',10,2)->comment('Vanning Amount')->default(0.00);
            $table->decimal('v_bus_amt',10,2)->comment('Virus Busters Amount:')->default(0.00);
            $table->decimal('other_cost',10,2)->default(0.00);
            $table->decimal('discount',10,2)->default(0.00);
            $table->decimal('inv_amount',10,2)->default(0.00);
            $table->text('note')->nullable();
            
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
        Schema::dropIfExists('invoices');
    }
};
