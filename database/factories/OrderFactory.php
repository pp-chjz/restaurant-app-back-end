<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'total_price' =>  $this->faker->numberBetween(500,50000),
            'order_time' => $this->faker->dateTime(),
            'order_id' => $this->faker->numerify("order-####"),
            // 'tablenumber_id' => $this->faker->numerify("####"),
        ];
    }
}
