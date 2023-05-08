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
            $table->string('stock_id')->unique()->nullable();
            $table->string('name');
            $table->string('fullName');
            $table->text('description')->nullable();
            //$table->text('note')->nullable();
            $table->text('option')->nullable();
            $table->string('package')->nullable();
            $table->unsignedBigInteger('brand_id')->index()->foreign('brand_id')->references('id')->on('brands')->onDelete('cascade')->nullable();
            $table->unsignedBigInteger('sub_brand_id')->index()->foreign('sub_brand_id')->references('id')->on('sub_brands')->onDelete('cascade')->nullable();
            //$table->string('version')->nullable();
            $table->string('m3')->nullable();
            $table->string('v_link')->comment('video_link')->nullable();
            //$table->integer('v_model_id')->nullable();
            //$table->string('v_model')->nullable();//2000,2002 year model type
            $table->string('chassis_no')->nullable();
            $table->string('fob')->nullable();;
            $table->integer('steering')->nullable();
            $table->integer('body_type_id')->nullable();
            //$table->integer('sub_body_type_id')->nullable();
            $table->integer('door_id')->nullable();
            $table->integer('seat_id')->nullable();
            $table->integer('con_id')->nullable();
            $table->string('weight')->nullable();
            $table->integer('drive_id')->nullable();;
            $table->decimal('price',40,2)->nullable();
            //$table->integer('cc')->nullable();
            $table->integer('mileage')->nullable();;
            $table->integer('transmission_id')->nullable();
            $table->decimal('discount',10,2)->nullable();
            $table->integer('fuel_id')->nullable();
            $table->integer('ext_color_id')->nullable();
            $table->integer('int_color_id')->nullable();
            $table->integer('b_length')->comment('body_length')->nullable();
            //$table->integer('truck_size')->comment('truck size')->nullable();
            $table->integer('max_loading_capacity')->nullable();
            $table->string('e_size')->comment('engine size cc')->nullable();
            $table->string('e_info')->comment('engine info')->nullable();
            $table->string('e_code')->comment('engine code')->nullable();
            //$table->year('year')->comment('year')->nullable();
            //$table->string('year_count')->comment('year count value')->nullable();
            $table->date('reg_year')->comment('REGISTRATION YEAR/MONTH')->nullable();
            $table->year('manu_year')->comment('MANUFACTURE YEAR/MONTH')->nullable();
            $table->integer('inv_locatin_id')->nullable();;
            $table->tinyInteger('cd_player')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('sun_roof')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('leather_seat')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('alloy_wheels')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('power_steering')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('power_windows')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('air_con')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('anti_lock_brake_system')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('air_bag')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('radio')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('cd_changer')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('back_tire')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('dvd')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('tv')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('power_seat')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('grill_guard')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('rear_spoiler')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('central_locking')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('jack')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('spare_tire')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('wheel_spanner')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('fog_lights')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('back_camera')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('push_start')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('keyless_entry')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('esc')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('deg_360_cam')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('body_kit')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('side_airbag')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('power_mirror')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('side_skirts')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('front_lip_spoiler')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('navigation')->comment('1 for yes 0 for no')->nullable();
            $table->tinyInteger('turbo')->comment('1 for yes 0 for no')->nullable();
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
