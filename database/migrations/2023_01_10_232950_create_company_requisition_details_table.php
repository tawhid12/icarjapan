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
        Schema::create('company_requisition_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_requisition_id')->index()->foreign('company_requisition_id')->references('id')->on('company_requisitions')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('indent_id')->nullable()->index()->foreign('indent_id')->references('id')->on('indents')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index()->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_id')->nullable()->index()->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_board_id')->nullable()->index()->foreign('warehouse_board_id')->references('id')->on('warehouse_boards')->onDelete('cascade');
            $table->unsignedBigInteger('unit_style_id')->index()->foreign('unit_style_id')->references('id')->on('unit_styles')->onDelete('cascade');
            $table->string('location')->comment('Origin => HK / BD');
            $table->decimal('qty',40,20)->default(0)->nullable();
            $table->decimal('del_qty',40,20)->default(0)->nullable();
            $table->decimal('back_qty',40,20)->default(0)->nullable();
            $table->decimal('unit_price',40,20)->default(0)->nullable();
            $table->string('remarks')->nullable();
            $table->date('production_date')->nullable();
            $table->date('stock_date')->nullable();
            $table->integer('status')->default(0)->comment('0 in company , 1 out company, 2 back in company, 3 back out company');
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
        Schema::dropIfExists('company_requisition_details');
    }
};
