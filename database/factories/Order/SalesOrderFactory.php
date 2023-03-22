<?php

namespace Database\Factories\Order;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order\SalesOrder>
 */
class SalesOrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'quotation_id'      => null,
            'currency_id'       => 1,
            'customer_id'       => $this->faker->numberBetween(1, 5),
            'type_order_id'     => 1,
            'retailer_id'       => $this->faker->numberBetween(1, 5),
            'pph_id'            => $this->faker->numberBetween(1, 5),
            'number'            => $this->faker->numerify('SO/####/##/###'),
            'customer_po'       => $this->faker->numerify('PO/2023/01/###'),
            'use_vat'           => true,
            'order_date'        => $this->faker->unique()->dateTimeBetween('-7 days', '+2 months'),
            'request_date'      => $this->faker->unique()->dateTimeBetween('-7 days', '+2 months'),
            'rate'              => $this->faker->numberBetween(100.01, 100000.99),
            'discount_nominal'  => $this->faker->numberBetween(100.01, 100000.99),
            'discount_percentage' => $this->faker->numberBetween(0, 100),
            'subtotal_amount'   => $this->faker->numberBetween(200000.01, 10000000.99),
            'discount'          => $this->faker->numberBetween(200000.01, 10000000.99),
            'pph23'             => $this->faker->numberBetween(100.01, 100000.99),
            'vat'               => $this->faker->numberBetween(100.01, 100000.99),
            'total_amount'      => $this->faker->numberBetween(200000.01, 10000000.99),
            'status'            => 'pending',
            'created_by'        => 'admin',
        ];
    }
}
