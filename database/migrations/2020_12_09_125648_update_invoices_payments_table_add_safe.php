<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInvoicesPaymentsTableAddSafe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices_payments', function (Blueprint $table) {
            $table->integer('safe_id')->after('paid')->default(0);
            $table->integer('safe_payment_id')->after('safe_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices_payments', function (Blueprint $table) {
            //
        });
    }
}
