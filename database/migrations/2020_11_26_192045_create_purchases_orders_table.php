<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchasesOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchases_orders', function (Blueprint $table) {
            $table->id();
            $table->integer('supplier_id')->default(0);
            $table->date('purchase_date');
            $table->integer('discount_percentage')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->string('discount_reason')->nullable();
            $table->integer('shipping_fees')->default(0);
            $table->integer('purchase_total');
            $table->text('purchase_note')->nullable();
            $table->boolean('already_paid');
            $table->string('payment_method');
            $table->integer('safe_payment_id')->nullable();
            $table->integer('safe_id')->nullable();
            $table->boolean('already_delivered');
            $table->date('delivery_date')->nullable();
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
        Schema::dropIfExists('purchases_orders');
    }
}
