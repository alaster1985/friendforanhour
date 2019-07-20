<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('profile_id')->nullable()->default(null);
            $table->string('title', 100);
            $table->text('description');
            $table->string('name_from', 100)->nullable()->default(null);
            $table->string('email', 100)->nullable()->default(null);
            $table->bigInteger('status_id')->unsigned()->default(1);
            $table->bigInteger('moderator_id')->unsigned()->nullable()->default(null);
            $table->text('report')->nullable()->default(null);
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
        Schema::dropIfExists('tickets');
    }
}
