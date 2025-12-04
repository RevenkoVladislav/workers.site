<?php

namespace App\Http\Controllers\Worker;

use App\Http\Controllers\Controller;
use App\Models\Working;
use Illuminate\Http\Request;

class WorkingController extends Controller
{
    public function index()
    {
        $workings = Working::with(['manager', 'company'])->paginate(6)->withQueryString();
        return view('worker.workings.index', compact('workings'));
    }
}
