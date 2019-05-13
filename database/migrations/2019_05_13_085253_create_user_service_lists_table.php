<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserServiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_service_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('service_list_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();
            $table->boolean('main_service_mark')->default(false);
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
        Schema::dropIfExists('user_service_lists');
    }
}
