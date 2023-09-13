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
        Schema::table('purchased_vehicles', function (Blueprint $table) {
            $table->tinyInteger('ship_status')->default(0)->comment('1 for handover out 0 for pending')->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchased_vehicles', function (Blueprint $table) {
            $table->dropColumn('ship_status');
        });
    }
};
