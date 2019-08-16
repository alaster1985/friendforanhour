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
        Schema::table('profile_photos', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
        Schema::table('service_lists', function (Blueprint $table) {
            $table->foreign('service_type_id')->references('id')->on('service_types');
            $table->foreign('profile_id')->references('id')->on('profiles');
        });
        Schema::table('transactions', function (Blueprint $table) {
            $table->foreign('transaction_name_id')->references('id')->on('transaction_names');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('giving_access_moderator_id')->references('id')->on('users');
        });
        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('gender_id')->references('id')->on('genders');
            $table->foreign('profile_address_id')->references('id')->on('profile_addresses');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles')->onDelete('cascade')->onUpdate('cascade');
        });
        Schema::table('complains', function (Blueprint $table) {
            $table->foreign('complain_from_profile_id')->references('id')->on('profiles');
            $table->foreign('complain_against_profile_id')->references('id')->on('profiles');
        });
        Schema::table('friends', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('friend_id')->references('id')->on('profiles');
        });
        Schema::table('chats', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('friend_id')->references('id')->on('profiles');
        });
        Schema::table('tickets', function (Blueprint $table) {
            $table->foreign('status_id')->references('id')->on('ticket_statuses');
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('moderator_id')->references('id')->on('users');
        });
        Schema::table('bans', function (Blueprint $table) {
            $table->foreign('profile_id')->references('id')->on('profiles');
            $table->foreign('moderator_id_beginner')->references('id')->on('users');
            $table->foreign('moderator_id_amnesty')->references('id')->on('users');
        });
        Schema::table('articles', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('article_categories');
        });
        Schema::table('favorites', function (Blueprint $table) {
            $table->foreign('f_owner_profile_id')->references('id')->on('profiles');
            $table->foreign('favorite_profile_id')->references('id')->on('profiles');
        });
        Schema::table('black_lists', function (Blueprint $table) {
            $table->foreign('bl_owner_profile_id')->references('id')->on('profiles');
            $table->foreign('non_grata_profile_id')->references('id')->on('profiles');
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
