<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsManualQuantitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products_manual_quantities', function (Blueprint $table) {
            $table->id();
            $table->integer('product_id')->default(0);
            $table->integer('qty')->default(0);
            $table->integer('branch_id')->default(0);
            $table->integer('qty_before_add')->default(0);
            $table->integer('qty_after_add')->default(0);
            $table->integer('qty_price')->default(0);
            $table->datetime('qty_datetime')->nullable();
            $table->text('qty_notes')->nullable();
            $table->integer('added_by')->default(0);
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
        Schema::dropIfExists('products_manual_quantities');
    }
}
