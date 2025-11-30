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
                User::where('id', '>', 0)->delete();
                $this->info('Reset Users table done');
            } catch (\Throwable $error) {
                DB::rollBack();
                $this->error("Reset failed: {$error->getMessage()}");
            }
        }

//         Проходимся по массиву с ролями. Приводим их к имени: workers и получаем введенное значение.
//         Если ввели больше 0, то начинаем транзакцию, получаем роль из сущности Role.
//         Вызываем фабрику User(количество) указываем для какой роли создаем.
//         Имеет какую фабрику -> вызываем эту фабрику.
//         Создаем и завершаем транзакцию.

//        if (array_map(function ($roles) {
//            $this->option(strtolower($roles) . 's') ?? false;
//        }, array_keys($this->roles))
//    );
        foreach ($this->roles as $roleName => $factoryClass) {
            $count = $this->option(strtolower($roleName) . 's') ?? 0;
            if ($count > 0) {
                try {
                    $role = Role::where('name', $roleName)->first();
                    DB::beginTransaction();
                    User::factory($count)
                        ->for($role)
                        ->has($factoryClass::factory())
                        ->create();
                    DB::commit();
                    $this->info("Created $count $roleName");
                } catch (\Throwable $error) {
                    DB::rollback();
                    $this->error("Error: {$error->getMessage()}");
                }
            } else {
                $this->info("Nothing to create for $roleName");
            }
        }

//        if ($this->option('workers') > 0) {
//            try {
//                DB::beginTransaction();
//                Worker::factory($this->option('workers'))->create();
//                DB::commit();
//                $this->info('Workers created: ' . $this->option('workers'));
//            } catch (\Throwable $error) {
//                DB::rollback();
//                $this->error("Error: {$error->getMessage()}");
//            }
//        } else {
//            $this->info('No workers specified');
//        }
    }
}
