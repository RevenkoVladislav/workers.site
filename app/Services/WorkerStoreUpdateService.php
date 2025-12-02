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
    public function store($data)
    {
        return DB::transaction(function () use ($data): User {
            $user = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'],
                'password' => Hash::make($data['password'] ?? 'admin'), //если пароль передан то хэш пароля.
                'role_id' => Role::where('name', 'Worker')->value('id'),
            ]);

            $user->worker()->create([
                'age' => $data['age'] ?? null,
                'phone' => $data['phone'],
                'description' => $data['description'] ?? null,
                'is_married' => $data['is_married'] ?? false
            ]);

            event(new Registered($user));

            return $user;
        });
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
