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
            $table->string('first_name', 50);
            $table->string('second_name', 50);
            $table->date('date_of_birth');
            $table->text('about')->nullable();
            $table->bigInteger('city_id')->unsigned();
            $table->bigInteger('gender_id')->unsigned();
            $table->bigInteger('main_photo_id')->unsigned();
            $table->string('email')->unique();
            $table->string('phone', 50);
            $table->bigInteger('address_id')->unsigned();
            $table->boolean('is_deleted')->default(false);
            $table->boolean('is_banned')->default(false);
            $table->timestamp('ban_finish_time')->nullable();
            $table->boolean('sms_checked')->default(false);
            $table->boolean('is_locked')->default(true);
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
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
