<?php

namespace App\Http\Controllers;

use App\Models\Worker;
use Illuminate\Http\Request;
use App\Http\Requests\Worker\StoreUpdateRequest;

class WorkerController extends Controller
{
    public function index()
    {
        $workers = Worker::all();
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
    }

    public function show(Worker $worker)
    {
        return view('worker.show', compact('worker'));
    }

    public function edit(Worker $worker)
    {

    }

    public function update(StoreUpdateRequest $request, Worker $worker)
    {
        $data = $request->validated();
        $worker->update($data);
    }

    public function destroy(Worker $worker)
    {
        $worker->delete();
    }
}
