<x-layout.main>
    <div>
        <form action="{{ route('workers.index') }}" method="get">
            <x-forms.input name="name" label="name" placeholder="name"/>
            <button type="submit" class="w-100 btn btn-secondary">Filter</button>
        </form>
    </div>
    @if($workers->count())
    <div class="row row-cols-1 row-cols-md-3 mt-3 mb-lg-auto">
        @foreach($workers as $worker)
            <div class="col">
                <div class="card text-dark bg-light border-dark mb-3 p-3 text-center">
                    <div class="card-header">Worker Id: {{$worker->id}}</div>
                    <div class="card-body">
                        <p class="card-text"><b>Name:</b> {{ $worker->user->name }}</p>
                        <p class="card-text"><b>Surname:</b> {{ $worker->user->surname }}</p>
                        <p class="card-text"><b>Email:</b> {{ $worker->user->email }}</p>
                        <p class="card-text"><b>Age:</b> {{ $worker->age }}</p>
                        <p class="card-text"><b>Phone:</b> {{ $worker->phone }}</p>
                        <p class="card-text"><b>Description:</b> {{ substr($worker->description, 0, 15) . '...' }}</p>
                        <p class="card-text"><b>Is married:</b> {{ $worker->is_married ? 'Yes' : 'No' }}</p>
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
    <div class="d-flex justify-content-around">
        {{ $workers->links() }}
    </div>
    @else
        <div>
        <p class="fs-1 text-center text-muted text-break">По вашему запросу - <b>{{ $search ?? null }}</b> ничего не найдено :(</p>
        </div>
    @endif
</x-layout.main>
