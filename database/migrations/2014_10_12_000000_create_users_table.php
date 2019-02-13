<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('username')->unique();
            $table->string('name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->boolean('is_active')->default(0);
            $table->string('password');
            $table->string('avatar')->nullable();
            $table->string('user_type');
            $table->date('birthday');
            $table->string('gender',1);
            $table->string('first_phone');
            $table->string('second_phone')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->unsignedInteger('region_id')->nullable();
            $table->text('address')->nullable();
            $table->string('zip_code')->nullable();
            $table->unsignedInteger('group_id')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('groups');
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
