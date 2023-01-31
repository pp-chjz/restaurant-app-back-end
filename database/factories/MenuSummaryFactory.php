<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MenuSummaryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_summary_ID' => $this->faker->numerify("menu_summary-####"),
            'menu_summary_datetime' => $this->faker->dateTime(),
            'menu_id' => $this->faker->numerify("####"),
        ];
    }
}
