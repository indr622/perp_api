<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubGroup>
 */
class SubGroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'group_id' => $this->faker->numberBetween(1, 5),
            'name' => $this->faker->numerify('SubGroup ###'),
            'is_active' => $this->faker->boolean,
            'description' => $this->faker->numerify('Description ###'),
        ];
    }
}
