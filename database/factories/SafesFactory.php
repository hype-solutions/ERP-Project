<?php

namespace Database\Factories;

use App\Models\Safes;
use Illuminate\Database\Eloquent\Factories\Factory;

class SafesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Safes::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [

            'safe_name' => 'الفرع الرئيسي',
            'safe_balance' => '0',
            'branch_id' => '1',


        ];
    }
}
