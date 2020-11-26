<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSafesTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('safes_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('safe_from')->default(0);
            $table->integer('transfer_amount')->default(0);
            $table->integer('amount_before_transfer_from')->default(0);
            $table->integer('amount_after_transfer_from')->default(0);
            $table->integer('safe_to')->default(0);
            $table->integer('amount_before_transfer_to')->default(0);
            $table->integer('amount_after_transfer_to')->default(0);
            $table->dateTime('transfer_datetime')->nullable();
            $table->text('transfer_notes')->nullable();
            $table->integer('transfered_by')->default(0);
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
        Schema::dropIfExists('safes_transfers');
    }
}
