<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PromotionDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_in_promotion' => $this->faker->numerify("menu-####"),
            'promotion_detail_ID' => $this->faker->numerify("promotion_detail-####"),
            'promotion_id' => $this->faker->numerify("####"),
        ];
    }
}
