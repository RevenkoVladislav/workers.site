<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Requests\Worker\StoreUpdateRequest;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::paginate(6);
        return view('worker.index', compact('workers'));
    }

    public function create()
    {
        return view('worker.create');
    }

    public function store(StoreUpdateRequest $request)
    {
        $data = $request->validated();
        Worker::create($data);
        return to_route('workers.index')->with('success', 'Worker created successfully');
    }

    public function show(Worker $worker)
    {
        return view('worker.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {
        return view('worker.edit', compact('worker'));
    }

    public function update(StoreUpdateRequest $request, Worker $worker)
    {
        $data = $request->validated();
        $worker->update($data);
        return to_route('workers.show', $worker)->with('success', 'Worker updated successfully');
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
        return to_route('workers.index')->with('success', 'Worker deleted successfully');
    }
}
