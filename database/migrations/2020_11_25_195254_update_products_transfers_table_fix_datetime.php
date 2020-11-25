<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProductsTransfersTableFixDatetime extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products_transfers', function (Blueprint $table) {
            $table->dateTime('transfer_datetime')->default(null)->change();
            $table->text('transfer_notes')->nullable()->default('')->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products_transfers', function (Blueprint $table) {
            $table->integer('transfer_datetime')->change();
            $table->integer('transfer_notes')->change();
        });
    }
}
