<?php

namespace Database\Factories\Branches;

use App\Models\Branches\Branches;
use Illuminate\Database\Eloquent\Factories\Factory;

class BranchesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Branches::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => 1,
            'branch_name' => 'الفرع الرئيسي',
            'branch_phone' => '0223456789',
            'branch_mobile' => '0123456789',
            'branch_email' => $this->faker->unique()->safeEmail,
            'branch_address' => 'برجاء التعديل و ادخال العنوان الرئيسي',

        ];
    }
}
