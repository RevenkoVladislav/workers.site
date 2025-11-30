<?php

namespace App\Console\Commands;

use App\Models\Manager;
use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateData extends Command
{
    protected $signature = "generate:data
                            {--workers=0 : generate N Workers},
                            {--managers=0 : generate N Managers},
                            {--reset : Reset table Users } ";

    protected $description = 'Generate users data for testing';

    protected array $roles = [
        'Worker' => Worker::class,
        'Manager' => Manager::class,
    ];

    public function handle()
    {
        if ($this->option('reset')) {
            try {
                // Отключаю проверку foreign key для сброса таблиц с юзерами.
                // Прошлый вариант User::where('id', '>', 0)->delete(); он более медленный
                DB::statement('SET FOREIGN_KEY_CHECKS=0;');
                User::truncate();
                Worker::truncate();
                Manager::truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                $this->info('Users reset done');
                return;
            } catch (\Throwable $error) {
                $this->error("Reset failed: {$error->getMessage()}");
                return;
            }
        }

        //если не ввели роль - то цикл не делаем
        if (!$this->option('workers') && !$this->option('managers')) {
            $this->warn('No generation workers provided. Use --workers=1 or/and --managers=1');
            return;
        }

        //грузим все роли
        $roles = Role::whereIn('name', array_keys($this->roles))
            ->get()
            ->keyBy('name');


        //проходим по массиву, приравниваем все роли к виду 'workers'
        foreach ($this->roles as $roleName => $factoryClass) {
            $count = (int)$this->option(strtolower($roleName) . 's') ?? 0;

            //число не передано - пропускаем
            if ($count <= 0) continue;

            //не найдена роль - вывод ошибки и пропуск
            if (!$roles->has($roleName)) {
                $this->error("Role {$roleName} not found");
                continue;
            }

            //используем транзакцию с замыканием и передаем все данные
            DB::transaction(function () use ($count, $roles, $roleName, $factoryClass) {
                User::factory($count)
                    ->for($roles[$roleName])
                    ->has($factoryClass::factory())
                    ->create();
            });

            $this->info("Created $count {$roleName}s");
        }
    }
}
