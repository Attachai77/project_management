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
            $table->bigIncrements('id');
            $table->string('username',32)->unique();
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('email',64)->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->integer('created_uid')->nullable();
            $table->integer('updated_uid')->nullable();
            $table->string('tel_no',10)->nullable();
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
