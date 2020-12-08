<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id')->default(0);
            $table->integer('branch_id')->default(0);
            $table->integer('safe_id')->default(0);
            $table->integer('safe_transaction_id')->default(0);
            $table->date('invoice_date');
            $table->integer('invoice_tax')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('discount_percentage')->default(0);
            $table->text('discount_reason')->nullable();
            $table->integer('shipping_fees')->default(0);
            $table->integer('invoice_total')->default(0);
            $table->text('invoice_note')->nullable();
            $table->string('payment_method');
            $table->boolean('already_paid')->default(FALSE);
            $table->boolean('was_price_quotation')->default(FALSE);
            $table->integer('price_quotation_id')->default(0);
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
        Schema::dropIfExists('invoices');
    }
}
