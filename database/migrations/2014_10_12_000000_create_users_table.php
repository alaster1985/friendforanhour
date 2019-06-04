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
            $table->string('name', 50);
            $table->string('email', 100)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password', 100);
            $table->string('sms_code', 5)->nullable()->default(null);
            $table->boolean('sms_checked')->default(false);
            $table->boolean('is_deleted')->default(false);
            $table->string('uid', 50)->nullable()->default(null);
            $table->string('network', 50)->nullable()->default(null);
            $table->string('social_profile', 100)->nullable()->default(null);
            $table->string('identity', 100)->nullable()->default(null);
            $table->bigInteger('profile_id')->nullable()->default(null);
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
