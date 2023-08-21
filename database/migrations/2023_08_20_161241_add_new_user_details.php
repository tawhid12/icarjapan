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
        Schema::table('user_details', function (Blueprint $table) {
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_details', function (Blueprint $table) {
            $table->dropColumn('wife_husband_name');
            $table->dropColumn('father_name');
            $table->dropColumn('mother_name');
            $table->dropColumn('whatsapp');
            $table->dropColumn('facebook');
            $table->dropColumn('viver');
            $table->dropColumn('instagram');
            $table->dropColumn('gmail');
            $table->dropColumn('contact_no');
        });
    }
};
