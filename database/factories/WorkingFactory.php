<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Manager;
use App\Models\Working;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Working>
 */
class WorkingFactory extends Factory
{
    protected $model = Working::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->jobTitle(),
            'description' => $this->faker->text(),
            'company_id' => Company::get()->random()->id,
            'manager_id' => Manager::get()->random()->id,
            'status' => $this->faker->randomElement(['open', 'closed', 'in progress']),
            'work_date' => $this->faker->dateTimeThisYear(),
            'duration' => $this->faker->numberBetween(1, 24),
            'start_time' => $this->faker->time('H:i:s'),
            'end_time' => $this->faker->time('H:i:s')
        ];
    }
}
