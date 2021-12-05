<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateExternalFundsTableAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('external_funds', function (Blueprint $table) {
            $table->integer('safe_payment_id')->nullable()->after('safe_id');
            $table->date('date_payed')->nullable()->after('refund_date');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('external_funds', function (Blueprint $table) {
            //
        });
    }
}
