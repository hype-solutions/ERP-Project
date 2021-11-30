<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateInvoicesPriceQuotationTableAddDaysValid extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices_price_quotation', function (Blueprint $table) {
            $table->integer('days_valid')->default(15)->after('authorized_by');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices_price_quotation', function (Blueprint $table) {
            //
        });
    }
}
