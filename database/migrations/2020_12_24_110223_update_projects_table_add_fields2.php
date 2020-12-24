<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateProjectsTableAddFields2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('projects', function (Blueprint $table) {
            $table->integer('discount_amount')->after('project_end_date')->default(0)->nullable();
            $table->integer('discount_percentage')->after('discount_amount')->default(0)->nullable();
            $table->integer('tax')->after('discount_percentage')->default(0)->nullable();
            $table->integer('shipping_fees')->after('tax')->default(0)->nullable();
            $table->integer('total')->after('shipping_fees')->default(0)->nullable();
            $table->integer('created_by')->after('total')->nullable();
            $table->integer('authorized_by')->after('created_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('projects', function (Blueprint $table) {
            //
        });
    }
}
