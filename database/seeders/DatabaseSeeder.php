<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
          \App\Models\Branches\Branches::factory(1)->create();
          \App\Models\Safes\Safes::factory(1)->create();
    }
}
