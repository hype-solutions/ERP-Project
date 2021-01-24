<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateSafesTransactionsTableAddDirect extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('safes_transactions', function (Blueprint $table) {
            $table->integer('direct')->after('transaction_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('safes_transactions', function (Blueprint $table) {
            //
        });
    }
}
