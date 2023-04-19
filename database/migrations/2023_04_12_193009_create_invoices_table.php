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
            $table->date('invoice_date')->nullable();
            $table->integer('reserve_id')->nullable();
            $table->integer('vehicle_id')->nullable();
            $table->integer('customer_id')->nullable();
            $table->integer('executive_id')->nullable();
            $table->integer('auc_country_id')->nullable();
            $table->integer('des_country_id')->nullable();

            /*Pricing Details */
            $table->decimal('fob_amt',10,2)->default(0.00);
            $table->decimal('freight_amt',10,2)->default(0.00);
            $table->decimal('insu_amt',10,2)->comment('Insurance Amount')->default(0.00);
            $table->decimal('insp_amt',10,2)->comment('Inspect Amount')->default(0.00);
            $table->decimal('van_amt',10,2)->comment('Vanning Amount')->default(0.00);
            $table->decimal('v_bus_amt',10,2)->comment('Virus Busters Amount:')->default(0.00);
            $table->decimal('other_cost',10,2)->default(0.00);
            $table->decimal('discount',10,2)->default(0.00);

            /*Inspection Details*/
            $table->date('ins_req_date')->comment('Inspection Request Date')->nullable();
            $table->date('ins_pass_date')->comment('Inspection Pass Date')->nullable();

            /*Shipping Details */
            $table->integer('dep_port_id')->comment('Departure Port')->nullable();
            $table->integer('des_port_id')->comment('Destination Port')->nullable();
            $table->string('ship_name')->comment('Ship Name')->nullable();
            $table->string('voyage_no')->comment('Voyage No')->nullable();
            $table->date('est_arival_date')->comment('Est. Arrival Date:')->nullable();

            /*Consignee Details */
            $table->integer('consignee_id')->nullable();
            
            /*BL Details */
            $table->string('tracking_no')->comment('Tracking No')->nullable();
            $table->date('shipping_date')->comment('Shipping Date')->nullable();
           
            /*Document Details */
            $table->string('auc_sheet_url')->comment('Auction Sheet File')->nullable();
            $table->string('bill_of_land_1_url')->comment('Bill of Lading Copy File')->nullable();
            $table->string('bill_of_land_2_url')->comment('Bill of Lading Release File')->nullable();
            $table->string('exp_can_cer_url_1')->comment('Export Cancellation Certificate File English')->nullable();
            $table->string('exp_can_cer_url_2')->comment('Export Cancellation Certificate File Other Language')->nullable();
            
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
