<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesPriceQuotationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_price_quotation', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->default(0);
            $table->date('quotation_date');
            $table->integer('quotation_tax')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('discount_percentage')->default(0);
            $table->text('discount_reason')->nullable();
            $table->integer('shipping_fees')->default(0);
            $table->integer('quotation_total')->default(0);
            $table->text('quotation_note')->nullable();
            $table->string('quotation_status')->default('Pending');
            $table->integer('invoice_id')->default(0);
            $table->integer('sold_by')->default(0);
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
        Schema::dropIfExists('invoices_price_quotation');
    }
}
