<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Worker>
 */
class WorkerFactory extends Factory
{
    protected $model = Worker::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'age' => fake()->numberBetween(18, 80),
            'phone' => fake()->unique()->phoneNumber(),
            'description' => fake()->text(100),
            'is_married' => fake()->boolean(),
        ];
    }
}
