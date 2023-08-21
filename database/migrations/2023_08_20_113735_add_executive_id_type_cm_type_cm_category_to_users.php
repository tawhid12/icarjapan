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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('executiveId')->after('status');
            $table->tinyInteger('type')->comment('1 => Active (Running deals on going) 2=> Semi Active (Purchased previously but at present no deals is running), 3 => Inactive (No purchase history or no deals is running)')->after('executiveId');
            $table->string('cmType',50)->comment('* => Sp, ** (extra Special Customer)')->after('type');
            $table->tinyInteger('cm_category')->comment('1 => Dealer 2=> Individual, 3 => Broker')->after('cmType');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('executiveId');
            $table->dropColumn('type');
            $table->dropColumn('cmType');
            $table->dropColumn('cm_category');
        });
    }
};
