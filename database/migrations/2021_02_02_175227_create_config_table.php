<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateConfigTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('config', function (Blueprint $table) {
            $table->id();
            $table->integer('installed')->default(0);
            $table->dateTime('installed_at')->nullable();
            $table->string('owner_name')->nullable();
            $table->string('owner_mobile')->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('renewal_status')->default(0);
            $table->date('next_renewal_date')->nullable();
            $table->string('licence_key')->nullable();
            $table->timestamps();
        });
            $data = [
                [
                    'installed'=> 0,
                ],

            ];
            DB::table('config')->insert($data);

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('config');
    }
}
