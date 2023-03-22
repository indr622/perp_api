<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\Customer>
 */
class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'term_payment_id' => 1,
            'name' => $this->faker->numerify('Customer ###'),
            'owner' => $this->faker->name,
            'pic_name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->unique()->phoneNumber,
            'bank_name' => $this->faker->numerify('Bank ###'),
            'bank_account_number' => $this->faker->numerify('###'),
            'bank_account_name' => $this->faker->name,
            'is_active' => $this->faker->boolean,
            'address' => $this->faker->address,
        ];
    }
}
