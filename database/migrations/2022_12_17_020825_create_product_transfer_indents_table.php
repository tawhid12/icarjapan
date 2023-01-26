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
        Schema::create('product_transfer_indents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('indent_id')->index()->foreign('indent_id')->references('id')->on('indents')->onDelete('cascade');
            $table->unsignedBigInteger('indent_to_id')->index()->foreign('indent_to_id')->references('id')->on('indents')->onDelete('cascade');
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->decimal('qty',40,20);
            $table->date('stock_date')->nullable();
            $table->date('production_date')->nullable();
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
        Schema::dropIfExists('product_transfer_indents');
    }
};
