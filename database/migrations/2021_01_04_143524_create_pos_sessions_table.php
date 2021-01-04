<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePosSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pos_sessions', function (Blueprint $table) {
            $table->id();
            $table->integer('branch_id')->default(1);
            $table->integer('status')->default(0);
            $table->integer('total')->default(0);
            $table->integer('discount_amount')->default(0);
            $table->integer('discount_percentage')->default(0);
            $table->integer('tax')->default(0);
            $table->integer('delivery')->default(0);
            $table->integer('open_by')->default(0);
            $table->integer('sold_by')->default(0);
            $table->dateTime('sold_when');
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
        Schema::dropIfExists('pos_sessions');
    }
}
