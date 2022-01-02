<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_refunds', function (Blueprint $table) {
            $table->id();
            $table->integer('pos_session_id');
            $table->integer('full_refund')->default(0);
            $table->integer('branch_id')->default(0);
            $table->integer('customer_id')->default(0);
            $table->integer('total_before')->default(0);
            $table->integer('total_after')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('discount_percentage')->default(0);
            $table->integer('tax')->default(0);
            $table->integer('delivery')->default(0);
            $table->integer('refunded_by')->default(0);
            $table->dateTime('refunded_when');
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
        Schema::dropIfExists('pos_refunds');
    }
}
