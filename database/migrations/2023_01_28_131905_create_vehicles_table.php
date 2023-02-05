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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('stock_id')->nullable();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('note')->nullable();
            $table->unsignedBigInteger('brand_id')->index()->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->nullable();
            $table->string('version')->nullable();
            $table->string('m3')->nullable();
            $table->string('weight')->nullable();
            $table->string('v_link')->comment('video_link')->nullable();
            $table->integer('v_model_id')->nullable();;
            $table->string('model_code')->nullable();;
            $table->string('chassis_no')->nullable();;
            $table->string('fob')->nullable();;
            $table->integer('steering')->nullable();;
            $table->integer('body_type_id')->nullable();;
            $table->integer('sub_body_type_id')->nullable();;
            $table->integer('drive_id')->nullable();;
            $table->decimal('price',40,20)->nullable();;
            $table->integer('cc')->nullable();;
            $table->integer('mileage')->nullable();;
            $table->integer('transmission_id')->nullable();;
            $table->decimal('discount',10,2)->nullable();;
            $table->integer('fuel_id')->nullable();;
            $table->string('color_id')->nullable();
            $table->integer('b_length')->comment('body_length')->nullable();
            $table->integer('max_loading_capacity')->nullable();
            $table->integer('e_size')->comment('engine_size')->nullable();
            $table->year('year')->comment('year')->nullable();
            $table->date('reg_year')->comment('REGISTRATION YEAR/MONTH')->nullable();
            $table->date('manu_year')->comment('MANUFACTURE YEAR/MONTH')->nullable();
            $table->integer('inv_locatin_id')->nullable();;
            $table->tinyInteger('air_bag')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('anti_lock_brake_system')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('air_con')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('back_tire')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('fog_lights')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('grill_guard')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('leather_seats')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('navigation')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('power_steering')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('power_windows')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('roof_rails')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('rear_spoiler')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('sun_roof')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('tv')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('dual_air_bags')->comment('1 for yes 0 for no')->nullable();
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
        Schema::dropIfExists('vehicles');
    }
};
