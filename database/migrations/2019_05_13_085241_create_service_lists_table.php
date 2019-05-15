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
            $table->integer('price')->unsigned();
            $table->bigInteger('service_type_id')->unsigned();
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
