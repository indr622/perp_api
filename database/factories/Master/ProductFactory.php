<?php

namespace Database\Factories\Master;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Master\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'retailer_id'       => $this->faker->numberBetween(1, 2),
            'item_id'           => $this->faker->numberBetween(1, 2),
            'unit_id'           => $this->faker->numberBetween(1, 2),
            'name'              => $this->faker->numerify('Product ###'),
            'description'       => $this->faker->text(100),
            'thick'             => $this->faker->numberBetween(1, 10),
            'width'             => $this->faker->numberBetween(1, 10),
            'length'            => $this->faker->numberBetween(1, 10),
            'flap'              => $this->faker->numberBetween(1, 10),
            'gusset'            => $this->faker->numberBetween(1, 10),
            'pillow_bag'        => 'pillow',
            'pillow_fold'       => null,
            'airhole'           => 3,
            'sealtape'          => 2,
            'sealtape_type'     => 'non permanent',
            'color'             => 'black',
            'printing'          => $this->faker->boolean(),
            'perforation'       => $this->faker->boolean(),
            'price'             => $this->faker->numberBetween(100.01, 100000.99),
            'price_buy'             => $this->faker->numberBetween(100.01, 100000.99),
            'is_active'         => true,
        ];
    }
}
