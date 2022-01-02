<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePosSessionsTableAddRefundFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pos_sessions', function (Blueprint $table) {
            $table->integer('refunded_by')->default(0)->after('sold_by');
            $table->dateTime('refunded_when')->nullable()->after('sold_when');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pos_sessions', function (Blueprint $table) {
            //
        });
    }
}
