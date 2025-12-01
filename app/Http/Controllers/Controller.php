<?php

namespace App\Http\Controllers;

use App\Services\WorkerStoreUpdateService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, DispatchesJobs;

    protected WorkerStoreUpdateService $workerService;
    public function __construct(WorkerStoreUpdateService $service)
    {
        $this->workerService = $service;
    }
}
