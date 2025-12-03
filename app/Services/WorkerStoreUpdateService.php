<?php

namespace App\Services;

use App\Events\WorkerCreated;
use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class WorkerStoreUpdateService
{
    protected int $workerRoleId;

    public function __construct()
    {
        $this->workerRoleId = Role::where('name', 'worker')->value('id');
    }
    public function store(array $data, bool $createdByManager = false): User
    {
        $password = $data['password'] ?? Str::random(8);

        $user = DB::transaction(function () use ($data, $password): User {
            $newUser = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'],
                //при регистрации пароль создает пользователь.
                // При регистрации через менеджера пароль генерируется автоматически и отправляется на почту.
                'password' => Hash::make($password),
                'role_id' => $this->workerRoleId,
            ]);

            $newUser->worker()->create([
                'age' => $data['age'] ?? null,
                'phone' => $data['phone'],
                'description' => $data['description'] ?? null,
                'is_married' => $data['is_married'] ?? false
            ]);
            return $newUser;
        });
        //используем вне транзакции


        //запускаем событие для отправки письма на почту с паролем
        if($createdByManager){
            event(new Registered($user));
            event(new WorkerCreated($user, $password, $createdByManager));
        }


        return $user;
    }

    public function update($data, Worker $worker): User
    {
        return DB::transaction(function () use ($data, $worker) {
            $worker->user->update([
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email']
            ]);

            $worker->update([
                'age' => $data['age'] ?? null,
                'phone' => $data['phone'],
                'description' => $data['description'] ?? null,
                'is_married' => $data['is_married'] ?? false
            ]);

            return $worker->user;
        });
    }
}
