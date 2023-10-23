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
        Schema::table('company_account_infos', function (Blueprint $table) {
            $table->tinyInteger('reserve_cancel')->default(0)->comment('Reserve cancel Day')->after('website');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company_account_infos', function (Blueprint $table) {
            $table->dropColumn('reserve_cancel');
        });
    }
};
