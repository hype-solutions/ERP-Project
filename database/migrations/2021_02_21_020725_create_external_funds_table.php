<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalFundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_funds', function (Blueprint $table) {
            $table->id();
            $table->integer('safe_id')->default(0);
            $table->string('investor');
            $table->integer('amount')->default(0);
            $table->date('funding_date');
            $table->date('refund_date');
            $table->string('paid')->default('No');
            $table->text('notes')->nullable();
            $table->integer('done_by')->default(0);
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
        Schema::dropIfExists('external_funds');
    }
}
