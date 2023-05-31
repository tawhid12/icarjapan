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
            $table->string('bank_code')->after('bank_address')->nullable();
            $table->string('beni_name')->after('bank_code')->nullable();;
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
            $table->dropColumn('bank_code');
            $table->dropColumn('beni_name');
        });
    }
};
