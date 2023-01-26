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
        Schema::create('product_transfer_indent_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transfer_id')->nullable()->index()->foreign('transfer_id')->references('id')->on('product_transfer_indents')->onDelete('cascade');
            $table->unsignedBigInteger('indent_id')->nullable()->index()->foreign('indent_id')->references('id')->on('indents')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index()->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_id')->nullable()->index()->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_board_id')->nullable()->index()->foreign('warehouse_board_id')->references('id')->on('warehouse_boards')->onDelete('cascade');
            $table->unsignedBigInteger('unit_style_id')->index()->foreign('unit_style_id')->references('id')->on('unit_styles')->onDelete('cascade');
            $table->string('location')->comment('Origin => HK / BD');
            $table->decimal('qty',40,20);
            $table->decimal('unit_price',40,20)->default(0);
            $table->string('remarks')->nullable();
            $table->date('stock_date')->nullable();
            $table->integer('status')->default(0)->comment('0 in , 1 out, 2 back out (in before), 3 back in (out before)');
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
        Schema::dropIfExists('product_transfer_indent_details');
    }
};
