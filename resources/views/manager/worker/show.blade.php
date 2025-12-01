<x-layout.main :title="$worker->name">
    <div class="container">
        <div class="row mt-3 col-sm-auto">
            <div class="card text-dark bg-light border-dark mb-3 p-3 text-center">
                <div class="card-header">Worker Id: {{$worker->id}}</div>
                <div class="card-body">
                    <p class="card-text"><b>Name:</b> {{ $worker->user->name }}</p>
                    <p class="card-text"><b>Surname:</b> {{ $worker->user->surname }}</p>
                    <p class="card-text"><b>Email:</b> {{ $worker->user->email }}</p>
                    <p class="card-text"><b>Age:</b> {{ $worker->age }}</p>
                    <p class="card-text"><b>Phone:</b> {{ $worker->phone }}</p>
                    <p class="card-text"><b>Description:</b> {{ $worker->description }}</p>
                    <p class="card-text"><b>Is married:</b> {{ $worker->is_married ? 'Yes' : 'No' }}</p>
                    <a href="{{ route('workers.edit', $worker) }}" class="btn btn-outline-success mt-2">Edit</a>
                    <form action="{{ route('workers.destroy', $worker) }}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <input type="submit" value="Delete" class="btn btn-outline-danger mt-2"
                               onclick="return confirm('Delete {{ $worker->name }} ?')">
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-layout.main>
