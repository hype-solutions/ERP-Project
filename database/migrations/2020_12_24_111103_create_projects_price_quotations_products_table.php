<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsPriceQuotationsProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_price_quotations_products', function (Blueprint $table) {
            $table->id();
            $table->integer('project_id');
            $table->integer('customer_id');
            $table->integer('product_id');
            $table->string('product_temp');
            $table->text('product_desc')->nullable();
            $table->integer('product_price');
            $table->integer('product_qty');
            $table->string('status')->default('no');
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
        Schema::dropIfExists('projects_price_quotations_products');
    }
}
