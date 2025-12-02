<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Worker\StoreUpdateRequest;
use App\Mail\User\PasswordMail;
use App\Models\Worker;
use App\Services\WorkerSearchService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class WorkerController extends Controller
{
    public function index(Request $request, WorkerSearchService $searchService)
    {
        $workers = $searchService->search($request);
        $search = $request->get('search');
        return view('manager.worker.index', compact('workers', 'search'));
    }

    public function create()
    {
        return view('manager.worker.create');
    }

    public function store(StoreUpdateRequest $request)
    {
        $data = $request->validated();
        $password = Str::random(8);
        $data['password'] = $password;
        $user = $this->workerService->store($data);
        Mail::to($user->email)->send(new PasswordMail($password, $user->name));
        return to_route('workers.index')->with('success', 'Worker created successfully');
    }

    public function show(Worker $worker)
    {
        return view('manager.worker.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        return view('manager.worker.edit', ['worker' => $worker, 'user' => $worker->user]);
    }

    public function update(StoreUpdateRequest $request, Worker $worker)
    {
        $data = $request->validated();
        $this->workerService->update($data, $worker);
        return to_route('workers.show', $worker)->with('success', 'Worker updated successfully');
    }

    public function destroy(Worker $worker)
    {
        $worker->user->delete();
        return to_route('workers.index')->with('success', 'Worker deleted successfully');
    }
}
