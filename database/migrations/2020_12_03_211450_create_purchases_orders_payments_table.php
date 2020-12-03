<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\Types\Nullable;

class CreatePurchasesOrdersPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_orders_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id');
            $table->integer('purchase_id');
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
        Schema::dropIfExists('purchases_orders_payments');
    }
}
