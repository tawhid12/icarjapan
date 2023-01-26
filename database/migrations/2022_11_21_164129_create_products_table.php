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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->index()->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->string('item_code')->nullable();
            $table->string('name')->nullable();
            $table->integer('item_type')->comment('1=>finish 2=>Semi-Finished 3=>Sub Material 4=>Raw Material');
            $table->decimal('unit_price',40,20)->default(0)->nullable();
            $table->text('description')->nullable();
            $table->string('size')->nullable();
            $table->string('color')->nullable();
            $table->unsignedBigInteger('unit_style_id')->index()->foreign('unit_style_id')->references('id')->on('unit_styles')->onDelete('cascade');
            $table->unsignedBigInteger('buyer_id')->nullable()->index()->foreign('buyer_id')->references('id')->on('buyers')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
};
