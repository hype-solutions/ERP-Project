<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('invoice_id');
            $table->integer('amount')->default(0);
            $table->date('date');
            $table->text('notes')->nullable();
            $table->string('paid')->default('No');
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
        Schema::dropIfExists('invoices_payments');
    }
}
