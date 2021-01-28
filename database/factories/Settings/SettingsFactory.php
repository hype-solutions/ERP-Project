<?php

namespace Database\Factories\Settings;

use App\Models\Settings\Settings;
use Illuminate\Database\Eloquent\Factories\Factory;

class SettingsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Settings::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            [
            'key' => 'company_name',
            'value' => 'test',
            ],
            [
            'key' => 'company_logo',
            'value' => '123',
            ],
        ];
    }
}
