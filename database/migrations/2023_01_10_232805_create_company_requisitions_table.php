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
        Schema::create('company_requisitions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id')->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->unsignedBigInteger('company_id_to')->index()->foreign('company_id_to')->references('id')->on('companies')->onDelete('cascade');
            $table->decimal('qty',40,20);
            $table->date('creq_date')->nullable()->comment('company requisition date');
            $table->string('slip_no')->default(0);
            $table->string('issue_by')->nullable(0);
            $table->string('received_by')->nullable();
            $table->string('delivary_by')->nullable();
            $table->text('remarks')->nullable();
            $table->integer('status')->default(0)->comment('0 Requisition, 1 Accept, 2 Full Back');
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
        Schema::dropIfExists('company_requisitions');
    }
};
