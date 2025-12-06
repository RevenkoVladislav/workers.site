<?php

namespace App\Console\Commands;

use App\Models\Company;
use App\Models\Manager;
use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use App\Models\Working;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class GenerateData extends Command
{
    protected $signature = "generate:data
                            {--companies=0 : generate N Companies},
                            {--workers=0 : generate N Workers},
                            {--managers=0 : generate N Managers},
                            {--workings=0 : generate N Workings},
                            {--reset : Reset table Users }";

    protected $description = 'Generate users/companies/workings data for testing. Use it 1.companies 2.workers 3.managers 4.workings';

    //для дальнейшего добавление необходимо внести сюда роль. И при желании добавить проверку перед циклом.
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
                Company::truncate();
                Working::truncate();
                Worker::truncate();
                Manager::truncate();
                DB::statement('SET FOREIGN_KEY_CHECKS=1;');

                $this->info('Users/Companies/Workings reset done');
                return;
            } catch (\Throwable $error) {
                $this->error("Reset failed: {$error->getMessage()}");
                return;
            }
        }

        if($this->option('companies')) {
            $countCompanies = $this->option('companies');
            try {
                DB::beginTransaction();
                Company::factory($countCompanies)->create();
                DB::commit();
                $this->info("Created $countCompanies Companies");
            } catch (\Throwable $error) {
                DB::rollBack();
                $this->error("Generate companies failed: {$error->getMessage()}");
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
            if ($count <= 0) {
                continue;
            }

            //Защита если роли нет в таблице ролей
            if(!$roles->has($roleName)) {
                $this->error("Role '$roleName' not found");
                continue;
            }

            //используем транзакцию с замыканием и передаем все данные
            try {
                DB::transaction(function () use ($count, $roles, $roleName, $factoryClass) {
                    User::factory($count)
                        ->for($roles[$roleName])
                        ->has($factoryClass::factory())
                        ->create();
                });
                $this->info("Created $count {$roleName}s");
            } catch (\Throwable $error) {
                $this->error("Error: {$error->getMessage()}");
            }
        }

        if($this->option('workings')) {
            $countWorkings = $this->option('workings');

            try {
                DB::beginTransaction();
                Working::factory($countWorkings)->create();
                DB::commit();
                $this->info("Created $countWorkings Workings");
            } catch (\Throwable $error) {
                $this->error("Generate workings failed: {$error->getMessage()}");
            }
        }
    }
}
