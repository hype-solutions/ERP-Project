<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if(DB::table('branches')->get()->count() == 0){
          \App\Models\Branches\Branches::factory(1)->create();
        }
        if(DB::table('safes')->get()->count() == 0){
          \App\Models\Safes\Safes::factory(1)->create();
          }
        // if(DB::table('settings')->get()->count() == 0){
        //     \App\Models\Settings\Settings::factory(1)->create();
        //   }
    }
}
