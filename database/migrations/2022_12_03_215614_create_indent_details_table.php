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
        Schema::create('indent_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indent_id')->index()->foreign('indent_id')->references('id')->on('indent')->onDelete('cascade');
            $table->unsignedBigInteger('product_id')->index()->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->unsignedBigInteger('unit_style_id')->index()->foreign('unit_style_id')->references('id')->on('unit_styles')->onDelete('cascade');
            $table->decimal('qty',40,20)->default(0);
            $table->decimal('weight',40,20)->default(0);
            $table->decimal('price',40,20)->default(0);
            $table->text('description')->nullable();
            $table->boolean('status')->default(1)->comment('1=>active 2=>inactive');
            $table->unsignedBigInteger('created_by')->index()->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('updated_by')->nullable()->index()->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('indent_details');
    }
};
