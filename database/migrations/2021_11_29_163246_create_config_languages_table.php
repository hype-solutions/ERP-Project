<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config_languages', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->enum('direction',['RTL','LTR'])->default('RTL');
            $table->string('flag')->default('<i class="flag-icon flag-icon-eg"></i>');
            $table->integer('used')->default('0');
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
        Schema::dropIfExists('config_languages');
    }
}
