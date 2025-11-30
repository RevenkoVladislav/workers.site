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
    public function index(Request $request, WorkerSearchService $searchService)
    {
        $workers = $searchService->search($request);
        $search = $request->get('search');
        return view('worker.index', compact('workers', 'search'));
    }

    public function create()
    {
        return view('worker.create');
    }

    public function store(StoreUpdateRequest $request)
    {
        $data = $request->validated();
        $this->workerService->store($data);
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
        $this->workerService->update($data, $worker);
        return to_route('workers.show', $worker)->with('success', 'Worker updated successfully');
    }

    public function destroy(Worker $worker)
    {
        $worker->user->delete();
        return to_route('workers.index')->with('success', 'Worker deleted successfully');
    }
}
