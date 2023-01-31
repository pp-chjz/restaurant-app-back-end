<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'price' =>  $this->faker->numberBetween(500,50000),
            'menu_id' => $this->faker->numerify("menu-####"),
            'name_ENG' => $this->faker->firstNameMale(),
            'name_TH' => $this->faker->lastName(),
            'comment' => $this->faker->address(),
            'recipe_id' => $this->faker->numerify("####"),
            'promotion_id' => $this->faker->numerify("####"),
        ];
    }
}
