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
        Schema::create('requisition_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('requisition_id')->index()->foreign('requisition_id')->references('id')->on('requisitions')->onDelete('cascade');
            $table->unsignedBigInteger('indent_id')->index()->foreign('indent_id')->references('id')->on('indent')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index()->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('unit_style_id')->index()->foreign('unit_style_id')->references('id')->on('unit_styles')->onDelete('cascade');
            $table->decimal('qty',40,20);
            $table->decimal('del_qty',40,20)->default(0)->nullable();
            $table->date('last_del_date')->nullable();
            $table->date('req_date')->nullable();
            $table->string('spec')->nullable();
            $table->string('color')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->default(0)->comment('0 pending, 1 approved, 2 Partial Delivared, 3 Delivared');
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
        Schema::dropIfExists('requisition_details');
    }
};
