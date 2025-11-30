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

    protected $roles = [
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
                DB::rollBack();
                $this->error("Reset failed: {$error->getMessage()}");
                return;
            }
        }

//         Проходимся по массиву с ролями. Приводим их к имени: workers и получаем введенное значение.
//         Если ввели больше 0, то начинаем транзакцию, получаем роль из сущности Role.
//         Вызываем фабрику User(количество) указываем для какой роли создаем.
//         Имеет какую фабрику -> вызываем эту фабрику.
//         Создаем и завершаем транзакцию.

        if(!$this->option('workers') && !$this->option('managers')){
            $this->warn('No generation workers provided. Use --workers=1 or/and --managers=1');
        }

        foreach ($this->roles as $roleName => $factoryClass) {
            $count = (int)$this->option(strtolower($roleName) . 's') ?? 0;
            if ($count <= 0) continue;
            try {
                $role = Role::where('name', $roleName)->first();
                DB::beginTransaction();
                User::factory($count)
                    ->for($role)
                    ->has($factoryClass::factory())
                    ->create();
                DB::commit();
                $this->info("Created $count {$roleName}s");
            } catch (\Throwable $error) {
                DB::rollback();
                $this->error("Error: {$error->getMessage()}");
            }
        }
    }
}
