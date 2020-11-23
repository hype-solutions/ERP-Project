<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_code')->nullable()->unique();
            $table->string('procuct_category')->nullable();
            $table->string('product_sub_category')->nullable();
            $table->string('product_name');
            $table->integer('product_price');
            $table->integer('product_total_in')->default(0);
            $table->integer('product_total_out')->default(0);
            $table->string('product_desc')->nullable();
            $table->string('product_brand')->nullable();
            $table->boolean('product_track_stock')->default(FALSE);
            $table->integer('product_low_stock_thershold')->default(0)->nullable();
            $table->text('product_notes')->nullable();
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
        Schema::dropIfExists('products');
    }
}
