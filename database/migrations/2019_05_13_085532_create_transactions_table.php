<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('profile_id');
            $table->bigInteger('giving_access_moderator_id')->unsigned()->nullable()->default(null);
            $table->text('manual_access_reason')->nullable()->default(null);
            $table->bigInteger('transaction_name_id')->unsigned();
            $table->string('crc_signature_value');
            $table->string('me_crc_signature_value');
            $table->string('inv_id');
            $table->boolean('accepted')->default(null);
            $table->longText('request_json');
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
        Schema::dropIfExists('transactions');
    }
}
