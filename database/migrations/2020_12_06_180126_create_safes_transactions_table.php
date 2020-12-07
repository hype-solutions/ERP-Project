<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSafesTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safes_transactions', function (Blueprint $table) {
            $table->id();
            $table->integer('safe_id');
            $table->integer('transaction_type');
            $table->integer('transaction_amount');
            $table->text('transaction_notes')->nullable();
            $table->dateTime('transaction_datetime');
            $table->integer('done_by')->default(0);;
            $table->integer('authorized_by')->default(0);
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
        Schema::dropIfExists('safes_transactions');
    }
}
