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
            $table->unsignedBigInteger('role_id')->index()->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->string('password');
            $table->unsignedBigInteger('country_id')->index()->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->integer('port_id')->nullable();
            $table->string('image')->nullable();
            $table->integer('company_id')->nullable();
            $table->integer('department_id')->nullable();
            $table->integer('designation_id')->nullable();
            $table->integer('show_price')->nullable();
            $table->boolean('all_company_access')->nullable()->default(0)->comment('1=>active 2=>inactive');
            $table->boolean('status')->default(1)->comment('1=>active 2=>Semi Active 0 => Inactive');
            $table->string('last_login')->nullable();
            $table->string('last_login_ip')->nullable();
            $table->unsignedBigInteger('created_by')->comment('Assigned SalesExecutive =salesexecutiveId | Free = 0')->nullable();
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
                'country_id' => 20,
                'port_id'   => 48,
                'all_company_access' => 1,
                'show_price' => 1,
                'status' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'Sales Executive',
                'email' => 'sales@email.com',
                'contact_no' => '01600000001',
                'password' => Hash::make('sales'),
                'designation_id' => 1,
                'department_id' => 1,
                'role_id' => 3,
                'company_id' => 1,
                'country_id' => 20,
                'port_id'   => 48,
                'all_company_access' => 1,
                'show_price' => 1,
                'status' => 1,
                'created_at' => Carbon::now()
            ],
            [
                'name' => 'General User',
                'email' => 'user@email.com',
                'contact_no' => '01600000002',
                'password' => Hash::make('user'),
                'designation_id' => 1,
                'department_id' => 1,
                'role_id' => 4,
                'company_id' => 1,
                'port_id'   => 48,
                'country_id' => 20,
                'all_company_access' => 0,
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
