<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateSettingsTableAddBasicRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('settings', function (Blueprint $table) {
            $data = [
                ['key'=>'company_name', 'value'=> 'اسم الشركة'],
                ['key'=>'logo', 'value'=> 'logo_placeholder.png'],
                ['key'=>'address_1', 'value'=> 'رقم المبنى, الشارع'],
                ['key'=>'address_2', 'value'=> 'المدينة, الدوله'],
                ['key'=>'currency', 'value'=> 'ج.م']
            ];
            DB::table('settings')->insert($data);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('settings', function (Blueprint $table) {
            //
        });
    }
}
