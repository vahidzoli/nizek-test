<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StockPriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'date'       => $this->faker->date('Y-m-d'),
            'price'      => $this->faker->randomFloat(2, 0, 1000)
        ];
    }
}
