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
        Schema::table('reserved_vehicles', function (Blueprint $table) {
            $table->decimal('required_deposit',10,2)->default(0)->after('allocated');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('reserved_vehicles', function (Blueprint $table) {
            $table->dropColumn('required_deposit');
        });
    }
};
