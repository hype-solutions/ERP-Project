<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_transfers', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(0);
            $table->integer('branch_from')->default(0);
            $table->integer('transfer_qty')->default(0);
            $table->integer('qty_before_transfer_from')->default(0);
            $table->integer('qty_after_transfer_from')->default(0);
            $table->integer('branch_to')->default(0);
            $table->integer('qty_before_transfer_to')->default(0);
            $table->integer('qty_after_transfer_to')->default(0);
            $table->integer('transfer_datetime')->default(0);
            $table->integer('transfer_notes')->default(0);
            $table->integer('transfered_by')->default(0);
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
        Schema::dropIfExists('products_transfers');
    }
}
