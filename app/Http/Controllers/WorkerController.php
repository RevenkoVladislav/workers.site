<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use App\Models\Worker;
use App\Services\WorkerSearchService;
use Illuminate\Http\Request;
use App\Http\Requests\Worker\StoreUpdateRequest;
use Illuminate\Support\Facades\DB;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
//        $workers = $searchService->search($request);
//        $search = $request->get('search');

        $workers = Worker::with('user')->paginate(6)->withQueryString();
        return view('worker.index', compact('workers'));
    }

    public function create()
    {
        return view('worker.create');
    }

    public function store(StoreUpdateRequest $request)
    {
        $data = $request->validated();
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
        return to_route('workers.index')->with('success', 'Worker created successfully');
    }

    public function show(Worker $worker)
    {
        return view('worker.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        return view('worker.edit', ['worker' => $worker, 'user' => $worker->user]);
    }

    public function update(StoreUpdateRequest $request, Worker $worker)
    {
        $data = $request->validated();
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
        return to_route('workers.show', $worker)->with('success', 'Worker updated successfully');
    }

    public function destroy(Worker $worker)
    {
        $worker->user->delete();
        return to_route('workers.index')->with('success', 'Worker deleted successfully');
    }
}
