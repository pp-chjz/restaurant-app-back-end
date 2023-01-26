<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BillFactory extends Factory
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
            'generate_time' => $this->faker->dateTime(),
            'bill_id' => $this->faker->numerify("bill-####"),
            'tablenumber_id' => $this->faker->numerify("####"),
        ];
    }
}
