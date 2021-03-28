<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_payments', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('project_id');
            $table->integer('amount')->default(0);
            $table->date('date');
            $table->date('date_collected')->nullable();
            $table->text('notes')->nullable();
            $table->string('paid')->default('No');
            $table->integer('safe_id')->default(0);
            $table->integer('safe_payment_id')->default(0);
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
        Schema::dropIfExists('projects_payments');
    }
}
