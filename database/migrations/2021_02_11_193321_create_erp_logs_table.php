<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateERPLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('erp_log', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->string('action');
            $table->string('custom_id');
            $table->string('user_id');
            $table->dateTime('action_date');
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
        Schema::dropIfExists('e_r_p_logs');
    }
}
