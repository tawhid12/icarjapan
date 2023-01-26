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
        Schema::create('indents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_style_id')->index()->foreign('product_style_id')->references('id')->on('product_styles')->onDelete('cascade');
            $table->unsignedBigInteger('unit_style_id')->index()->foreign('unit_style_id')->references('id')->on('unit_styles')->onDelete('cascade');
            $table->string('indent_no')->default(0);
            $table->decimal('qty',40,20)->default(0)->nullable();
            $table->decimal('weight',40,20)->default(0)->nullable();
            $table->decimal('unit_price',40,20)->default(0)->nullable();
            $table->date('order_date')->nullable();
            $table->date('start_date')->nullable();
            $table->date('finish_date')->nullable();
            $table->date('actual_finish_date')->nullable();
            $table->text('description')->nullable();
            $table->unsignedBigInteger('buyer_id')->index()->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->boolean('status')->default(1)->comment('1=>active 2=>inactive');
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
        Schema::dropIfExists('indents');
    }
};
