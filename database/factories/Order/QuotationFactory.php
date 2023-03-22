<?php

namespace Database\Factories\Order;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order\Quotation>
 */
class QuotationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'currency_id'           => 1,
            'customer_id'           => $this->faker->numberBetween(1, 2),
            'type_order_id'         => 1,
            'retailer_id'           => $this->faker->numberBetween(1, 2),

            'customer_po'           => $this->faker->numerify('PO-23/######'),
            'quo_number'            => $this->faker->numerify('QUO-23/######'),
            'quo_use_vat'           => true,
            'quo_rate'              => $this->faker->numberBetween(100.01, 100000.99),
            'quo_order_date'        => $this->faker->unique()->dateTimeBetween('-7 days', '+2 months'),
            'quo_request_date'      => $this->faker->unique()->dateTimeBetween('-7 days', '+2 months'),
            'quo_discount_percent'  => $this->faker->numberBetween(100.01, 100000.99),
            'quo_discount_nominal'  => $this->faker->numberBetween(0, 100),
            'quo_subtotal'          => $this->faker->numberBetween(200000.01, 10000000.99),
            'quo_discount'          => $this->faker->numberBetween(200000.01, 10000000.99),
            'quo_vat'               => $this->faker->numberBetween(100.01, 100000.99),
            'quo_total'             => $this->faker->numberBetween(200000.01, 10000000.99),
            'quo_status'            => 'PROCESS',
            'quo_created_by'            => 'admin',
        ];
    }
}
