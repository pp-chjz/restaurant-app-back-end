<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'recipes_ID' => $this->faker->numerify("recipes-####"),
            'menu_id' => $this->faker->numerify("####"),
            'ingredient_id' => $this->faker->numerify("####"),
        ];
    }
}
