<x-layout.main>
    <div class="row row-cols-1 row-cols-md-3 mt-3 mb-lg-auto">
        @foreach($workers as $worker)
            <div class="col">
                <div class="card text-dark bg-light border-dark mb-3 p-3 text-center">
                    <div class="card-header">Worker Id: {{$worker->id}}</div>
                    <div class="card-body">
                        <p class="card-text"><b>Name:</b> {{ $worker->name }}</p>
                        <p class="card-text"><b>Surname:</b> {{ $worker->surname }}</p>
                        <p class="card-text"><b>Email:</b> {{ $worker->email }}</p>
                        <p class="card-text"><b>Age:</b> {{ $worker->age }}</p>
                        <p class="card-text"><b>Phone:</b> {{ $worker->phone }}</p>
                        <p class="card-text"><b>Description:</b> {{ $worker->description }}</p>
                        <p class="card-text"><b>Is married:</b> {{ $worker->is_married }}</p>
                        <a href="{{ route('workers.show', $worker) }}" class="btn btn-outline-secondary mt-2">Read more</a>
                        <a href="{{ route('workers.edit', $worker) }}" class="btn btn-outline-success w-25 mt-2">Edit</a>
                        <form action="{{ route('workers.destroy', $worker) }}" method="post" class="">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Delete" class="btn btn-outline-danger mt-2"
                                   onclick="return confirm('Delete {{ $worker->name }} ?')">
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-layout.main>
