<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class GlCodeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $code = $this->faker->numberBetween(5000, 500000);
        return [
            'account_code' => $code,
            'account_description' => $this->faker->unique()->words($nb=2,$asText=true),
            'access' => $this->faker->numberBetween(1, 2),
        ];
    }

}
