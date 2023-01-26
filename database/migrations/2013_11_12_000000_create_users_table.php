<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique()->nullable();
            $table->string('contact_no')->unique();
            $table->unsignedBigInteger('designation_id')->index()->foreign('designation_id')->references('id')->on('designations')->onDelete('cascade');
            $table->unsignedBigInteger('department_id')->index()->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
            $table->unsignedBigInteger('role_id')->index()->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->string('password');
            $table->unsignedBigInteger('company_id')->nullable()->index()->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->boolean('all_company_access')->nullable()->default(0)->comment('1=>active 2=>inactive');
            $table->boolean('show_price')->nullable()->default(0)->comment('1=>active 2=>inactive');
            $table->boolean('status')->default(1)->comment('1=>active 2=>inactive');
            $table->string('last_login')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });

        DB::table('users')->insert([
            [
                'name' => 'Superadmin',
                'email' => 'superadmin@email.com',
                'contact_no' => '01600000000',
                'password' => Hash::make('superadmin'),
                'designation_id' => 1,
                'department_id' => 1,
                'role_id' => 1,
                'company_id' => 1,
                'all_company_access' => 1,
                'show_price' => 1,
                'status' => 1,
                'created_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
