<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class IngredientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'ingredient_ID' => $this->faker->numerify("ingredient-####"),
            'ingredient_name_ENG' => $this->faker->firstNameMale(),
            'ingredient_name_TH' => $this->faker->lastName(),
            'recipe_id' => $this->faker->numerify("####"),
        ];
    }
}
