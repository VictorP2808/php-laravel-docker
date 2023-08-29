<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class PortfolioFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'shares_qty'=>$this->faker->numberBetween(1,100),
            'total_invested'=>$this->faker->randomFloat(2,0,100),
            'current_cost'=>$this->faker->randomFloat(2, 0,100),
            'gain'=>$this->faker->randomFloat(2, -100, 100),
            'performance_percentage'=>$this->faker->randomFloat(2, -100, 100),
            'last_purchase_date'=>$this->faker->dateTime()

        ];
    }
}
