<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCustomersTableAddCompanyExtra extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->string('customer_type')->after('customer_address')->nullable();
            $table->string('customer_commercial_registry')->after('customer_type')->nullable();
            $table->string('customer_tax_card')->after('customer_commercial_registry')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            $table->dropColumn(['customer_type', 'customer_commercial_registry', 'customer_tax_card']);

        });
    }
}
