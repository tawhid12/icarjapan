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
        Schema::create('product_out_stocks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indent_id')->index()->foreign('indent_id')->references('id')->on('indent')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index()->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_id')->index()->foreign('warehouse_id')->references('id')->on('warehouses')->onDelete('cascade');
            $table->unsignedBigInteger('warehouse_board_id')->index()->foreign('warehouse_board_id')->references('id')->on('warehouse_boards')->onDelete('cascade');
            $table->unsignedBigInteger('unit_style_id')->index()->foreign('unit_style_id')->references('id')->on('unit_styles')->onDelete('cascade');
            $table->unsignedBigInteger('requisition_id')->nullable();
            $table->string('location')->comment('Origin => HK / BD');
            $table->decimal('qty',40,20);
            $table->date('production_date')->nullable();
            $table->date('stock_date')->nullable();
            $table->string('remarks')->nullable();
            $table->integer('status')->default(0)->comment('0 in Production Line, 1 to other warehouse, 2 Return, 3 considerable, 4 unusable');
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
        Schema::dropIfExists('product_out_stocks');
    }
};
