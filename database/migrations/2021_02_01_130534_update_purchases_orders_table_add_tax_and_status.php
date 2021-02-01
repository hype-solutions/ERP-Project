<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdatePurchasesOrdersTableAddTaxAndStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('purchases_orders', function (Blueprint $table) {
            $table->integer('purchase_tax')->default(0)->after('shipping_fees');
            $table->string('purchase_status')->default('Created')->after('purchase_note');
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
