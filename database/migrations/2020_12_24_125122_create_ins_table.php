<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ins', function (Blueprint $table) {
            $table->id();
            $table->integer('category')->nullable();
            $table->integer('amount');
            $table->text('notes');
            $table->integer('safe_id');
            $table->integer('safe_transaction_id');
            $table->dateTime('transaction_datetime');
            $table->integer('done_by');
            $table->integer('authorized_by');
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
        Schema::dropIfExists('ins');
    }
}
