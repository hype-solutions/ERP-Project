<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsPurchasesOrdersPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_purchases_orders_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('supplier_id');
            $table->integer('amount')->default(0);
            $table->date('date');
            $table->date('date_collected')->nullable();
            $table->text('notes')->nullable();
            $table->string('paid')->default('No');
            $table->integer('safe_id')->nullable();
            $table->integer('safe_payment_id')->nullable();
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
        Schema::dropIfExists('projects_purchases_orders_payments');
    }
}
