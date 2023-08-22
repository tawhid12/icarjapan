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
        Schema::create('shipment_details', function (Blueprint $table) {
            $table->id();
            $table->integer('reserve_id')->nullable();
            $table->integer('vehicle_id')->nullable();
            $table->integer('client_id')->nullable();
            $table->integer('executiveId')->nullable();
            $table->integer('auc_country_id')->nullable();
            $table->integer('des_country_id')->nullable();

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
        Schema::dropIfExists('shipment_details');
    }
};
