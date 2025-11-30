<?php

namespace App\Services;

use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use Illuminate\Support\Facades\DB;

class WorkerStoreUpdateService
{
    public function store($data)
    {
        DB::transaction(function () use ($data) {
            $user = User::create([
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'] ?? null,
                'password' => 'admin', //временный пароль
                'role_id' => Role::where('name', 'Worker')->first()->id,
            ]);

            Worker::create([
                'user_id' => $user->id,
                'age' => $data['age'] ?? null,
                'phone' => $data['phone'],
                'description' => $data['description'] ?? null,
                'is_married' => $data['is_married'] ?? false
            ]);
        });
    }

    public function update($data, Worker $worker)
    {
        DB::transaction(function () use ($data, $worker) {
            $worker->user->update([
                'name' => $data['name'],
                'surname' => $data['surname'] ?? null,
                'email' => $data['email'] ?? null
            ]);

            $worker->update([
                'age' => $data['age'] ?? null,
                'phone' => $data['phone'],
                'description' => $data['description'] ?? null,
                'is_married' => $data['is_married'] ?? false
            ]);
        });
    }
}
