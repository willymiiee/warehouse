<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Requests extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('item_id');
            $table->string('status');
            $table->dateTime('created_at');
            $table->dateTime('approved_at')->nullable();
            $table->integer('approved_by')->nullable();
            $table->dateTime('rejected_at')->nullable();
            $table->integer('rejected_by')->nullable();
            $table->string('reject_note')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
}
