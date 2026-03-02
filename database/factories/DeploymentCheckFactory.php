<?php

namespace Database\Factories;

use App\Models\DeploymentCheck;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeploymentCheckFactory extends Factory
{
    protected $model = DeploymentCheck::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'is_completed' => false,
            'completed_at' => null,
        ];
    }

   
    public function completed(): Factory
    {

        return $this->state(function (array $attributes) {
            return [
                'is_completed' => true,
                'completed_at' => now(),
            ];
        });
        
    }
}
