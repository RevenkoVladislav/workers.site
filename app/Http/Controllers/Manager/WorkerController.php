<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Filters\Worker\WorkerFilter;
use App\Http\Filters\Worker\WorkerPipeline\WorkerAge;
use App\Http\Filters\Worker\WorkerPipeline\WorkerAgeFrom;
use App\Http\Filters\Worker\WorkerPipeline\WorkerAgeTo;
use App\Http\Filters\Worker\WorkerPipeline\WorkerEmail;
use App\Http\Filters\Worker\WorkerPipeline\WorkerName;
use App\Http\Filters\Worker\WorkerPipeline\WorkerPhone;
use App\Http\Filters\Worker\WorkerPipeline\WorkerSurname;
use App\Http\Requests\Manager\Worker\WorkerPipelineSearchRequest;
use App\Http\Requests\Worker\StoreUpdateRequest;
use App\Models\Worker;
use App\Services\WorkerSearchService;
use Illuminate\Http\Request;
use Illuminate\Pipeline\Pipeline;

class WorkerController extends Controller
{
    public function index(WorkerPipelineSearchRequest $request, WorkerSearchService $searchService)
    {
        //Объект query builder с user + workers для фильтра
        $query = Worker::query()->join('users', 'users.id', '=', 'workers.user_id')
            ->select('workers.*');

//        Вариант с обычным Filter
//        $data = $request->all();
//        $filter = new WorkerFilter($data);
//        $filter->applyFilter($query);
//        $workers = $query->paginate(6);

        //создаем Pipeline и отправляем в него query builder с user+workers
        //пройди по следующим фильтрам through
        $workers = app()->make(Pipeline::class)
            ->send($query)
            ->through([
                WorkerName::class,
                WorkerSurname::class,
                WorkerAge::class,
                WorkerAgeFrom::class,
                WorkerAgeTo::class,
                WorkerEmail::class,
                WorkerPhone::class,
            ])
            ->thenReturn();

        $workers = $workers->paginate(6);

//        $workers = $searchService->search($request);
//        $search = $request->get('search');
        return view('manager.worker.index', compact('workers'));
    }

    public function create()
    {
        return view('manager.worker.create');
    }

    public function store(StoreUpdateRequest $request)
    {
        $data = $request->validated();
        $this->workerService->store($data, true);
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
