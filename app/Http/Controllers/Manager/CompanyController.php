<?php

namespace App\Http\Controllers\Manager;

use App\Http\Controllers\Controller;
use App\Http\Requests\Manager\Company\StoreUpdateRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $companies = Company::all();
        return view('manager.company.index', compact('companies'));
    }

    public function create()
    {
        return view('manager.company.create');
    }

    public function store(StoreUpdateRequest $request)
    {
        $data = $request->validated();
        Company::create($data);
        return to_route('companies.index')->with('success', 'Worker created successfully');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
