<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;

class JobsController extends Controller
{
    public function index()
    {
        return view('worker.jobs.index');
    }
}
