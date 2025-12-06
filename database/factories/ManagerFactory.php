<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Manager;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Manager>
 */
class ManagerFactory extends Factory
{
    protected $model = Manager::class;
    public function definition(): array
    {
        return [
            'company_id' => Company::get()->random()->id
        ];
    }
}
