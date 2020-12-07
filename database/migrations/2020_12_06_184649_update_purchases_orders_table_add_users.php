<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePurchasesOrdersTableAddUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases_orders', function (Blueprint $table) {
            $table->integer('added_by')->after('delivery_date')->default(0);
            $table->integer('autherized_by')->after('delivery_date')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases_orders', function (Blueprint $table) {
            //
        });
    }
}
