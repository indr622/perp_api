<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\TypeOrder>
 */
class TypeOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->numerify('Type Order ###'),
            'use_dp' => $this->faker->boolean,
            'use_inv_out' => $this->faker->boolean,
            'is_active' => $this->faker->boolean,
        ];
    }
}
