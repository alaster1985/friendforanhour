<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('service_name', 14);
            $table->string('service_description', 100);
            $table->integer('price')->unsigned()->default(0);
            $table->bigInteger('service_type_id')->unsigned();
            $table->bigInteger('profile_id');
            $table->boolean('main_service_marker')->default(false);
            $table->boolean('is_disabled')->default(false);
            $table->boolean('is_deleted')->default(false);
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
        Schema::dropIfExists('service_lists');
    }
}
