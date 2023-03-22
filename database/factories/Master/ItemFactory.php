<?php

/**
 * Created by Indra Basuki.
 * Yubi Technology
 * Date: 2022-12-12
 */

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'group_id' => 1,
            'subgroup_id' => 1,
            'unit_id' => $this->faker->numberBetween(1, 2),
            'name' => $this->faker->numerify('Item ###'),
            'description' => $this->faker->numerify('Description ###'),
            'specification' => $this->faker->numerify('specification ###'),
            'price_buy' => $this->faker->numberBetween(1000, 1000000),
            'price_sell' => $this->faker->numberBetween(1000, 1000000),
            'price_formula' => $this->faker->numberBetween(1, 10),
            'is_active' => $this->faker->boolean,
        ];
    }
}
