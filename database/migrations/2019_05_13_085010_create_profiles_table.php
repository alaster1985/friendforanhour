<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->bigInteger('id', true, false);
            $table->string('first_name', 50)->nullable()->default(null);
            $table->string('second_name', 50)->nullable()->default(null);
            $table->date('date_of_birth')->nullable()->default(null);
            $table->integer('height')->nullable()->default(null);
            $table->integer('weight')->nullable()->default(null);
            $table->text('about')->nullable()->default(null);
            $table->bigInteger('gender_id')->unsigned()->nullable()->default(null);
            $table->string('phone', 50)->nullable()->default(null);
            $table->bigInteger('profile_address_id')->unsigned()->nullable()->default(null);
            $table->boolean('is_deleted')->default(false)->nullable();
            $table->boolean('is_banned')->default(false)->nullable();
            $table->timestamp('ban_finish_time')->nullable()->default(null);
            $table->boolean('is_locked')->default(false)->nullable();
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
        Schema::dropIfExists('profiles');
    }
}
