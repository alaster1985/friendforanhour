<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateForeignKeyRelationshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cities', function (Blueprint $table) {
            $table->foreign('country_id')->references('id')->on('countries');
        });
        Schema::table('profile_addresses', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities');
        });
        Schema::table('profile_photo', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
        Schema::table('service_lists', function (Blueprint $table) {
            $table->foreign('service_type_id')->references('id')->on('service_types');
        });
        Schema::table('profile_service_lists', function (Blueprint $table) {
            $table->foreign('service_list_id')->references('id')->on('service_lists');
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('transaction_id')->references('id')->on('transaction_names');
        });
        Schema::table('balances', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('city_id')->references('id')->on('cities');
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('address_id')->references('id')->on('profile_addresses');
//            $table->foreign('main_photo_id')->references('id')->on('profile_photo');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('foreign_key_relationships');
    }
}
