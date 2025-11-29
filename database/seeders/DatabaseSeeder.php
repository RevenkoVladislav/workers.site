<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)
            ->for(Role::where('name', 'Worker')->first())
            ->has(Worker::factory())
            ->create();
    }
}
