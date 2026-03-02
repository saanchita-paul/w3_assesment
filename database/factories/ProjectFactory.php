<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'owner_email' => $this->faker->unique()->safeEmail,
            'release_date' => $this->faker->date(),
        ];
    }

   
    public function configure()
    {
        
        return $this->afterCreating(function (Project $project) {
            DeploymentCheck::factory()->count(3)->for($project)->create();
            DeploymentCheck::factory()->count(2)->for($project)->completed()->create();
        });

    }
}
