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
        Schema::create('requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('indent_id')->index()->foreign('indent_id')->references('id')->on('indent')->onDelete('cascade');
            $table->unsignedBigInteger('product_style_id')->index()->foreign('product_style_id')->references('id')->on('product_styles')->onDelete('cascade');
            $table->date('req_date')->nullable();
            $table->decimal('qty',40,20)->default(0);
            $table->string('slip_no')->default(0);
            $table->string('line_no')->default(0);
            $table->string('issue_by')->nullable(0);
            $table->string('received_by')->nullable();
            $table->string('delivary_by')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->default(0)->comment('0 Pending, 1 Partial accept, 2 finish');
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
        Schema::dropIfExists('requisitions');
    }
};
