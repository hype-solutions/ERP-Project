<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outs', function (Blueprint $table) {
            $table->id();
            $table->integer('category')->nullable();
            $table->integer('entity')->nullable();
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
        Schema::dropIfExists('outs');
    }
}
