<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class TablenumberFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'tablenumber' => $this->faker->firstNameFemale(),
        ];
    }
}
