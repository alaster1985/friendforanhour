<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('profile_id');
            $table->text('reason');
            $table->bigInteger('moderator_id_beginner')->unsigned();
            $table->integer('duration')->unsigned();
            $table->integer('ban_end_date')->unsigned();
            $table->bigInteger('moderator_id_amnesty')->unsigned()->nullable()->default(null);
            $table->text('reason_amnesty')->nullable()->default(null);
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
        Schema::dropIfExists('bans');
    }
}
