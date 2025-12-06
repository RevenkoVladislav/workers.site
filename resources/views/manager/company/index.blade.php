<x-layout.main>
    <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-3">
                <a href="{{ route('companies.create') }}" class="btn btn-block btn-outline-success">Add company</a>
            </div>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th scope="col">id</th>
                <th scope="col">Company</th>
                <th scope="col">Description</th>
            </tr>
            </thead>
            <tbody>
            @foreach($companies as $company)
                <tr>
                    <th scope="row">{{ $company->id }}</th>
                    <td>{{ $company->name }}</td>
                    <td>{{ substr($company->description, 0, 45) . '...' }}</td>
                </tr>
            @endforeach()
            </tbody>
        </table>
</x-layout.main>
