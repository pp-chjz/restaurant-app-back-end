<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_id' => $this->faker->numerify("####"),
            'promotion_ID' => $this->faker->numerify("promotion-####"),
            'promotion_name' => $this->faker->firstNameMale(),
            'promotion_date' => $this->faker->dateTime(),
            'promotion_price' =>  $this->faker->numberBetween(500,50000),
        ];
    }
}
