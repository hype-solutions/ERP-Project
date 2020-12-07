<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePurchasesOrdersPaymentsTableAddSafes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases_orders_payments', function (Blueprint $table) {
            $table->integer('safe_id')->after('paid')->nullable();
            $table->integer('safe_payment_id')->after('safe_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases_orders_payments', function (Blueprint $table) {
            //
        });
    }
}
