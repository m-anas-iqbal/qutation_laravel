<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->boolean('role_id')->default(2);
            $table->string('name');
            $table->string('email')->unique();
            $table->string('photo');
            $table->string('password');
            $table->longText('service_area');
            $table->string('business_name');
            $table->string('phone');
            $table->string('postcode');
            $table->string('business_type');
            $table->text('business_description');
            $table->string('no_of_employee');
            $table->boolean('status')->default(1);
            $table->boolean('is_get_email')->default(0);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
