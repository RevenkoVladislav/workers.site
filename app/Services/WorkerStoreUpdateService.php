<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class WorkerStoreUpdateService
{
    protected int $workerRoleId;

    public function __construct()
    {
        $this->workerRoleId = Role::where('name', 'worker')->value('id');
    }
    public function store($data)
    {
        $user = DB::transaction(function () use ($data): User {
            $user = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'],
                'password' => Hash::make($data['password'] ?? 'admin'), //если пароль передан то хэш пароля.
                'role_id' => $this->workerRoleId,
            ]);

            $user->worker()->create([
                'age' => $data['age'] ?? null,
                'phone' => $data['phone'],
                'description' => $data['description'] ?? null,
                'is_married' => $data['is_married'] ?? false
            ]);
            return $user;
        });
        //используем вне транзакции
        event(new Registered($user));
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
