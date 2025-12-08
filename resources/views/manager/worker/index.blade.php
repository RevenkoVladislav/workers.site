<x-layout.main>
    <div>
        <form action="{{ route('workers.index') }}" method="get" class="d-flex align-items-end gap-2 p-3 border rounded shadow-sm">
            <x-forms.input name="name" label="Name" placeholder="name"/>
            <x-forms.input name="surname" label="Surname" placeholder="Surname"/>
            <x-forms.input name="email" label="Email" placeholder="Email"/>
            <x-forms.input name="age" label="Age" placeholder="Age"/>
            <x-forms.input name="age_from" label="Age From" placeholder="Age From"/>
            <x-forms.input name="age_to" label="Age To" placeholder="Age To"/>
            <x-forms.input name="phone" label="Phone" placeholder="Phone format (8**********)"/>
            <div>
                <label class="form-check-label">Married ?</label>
                <input type="hidden" name="is_married" value="0">
                <input type="checkbox" name="is_married" value="1" class="form-check-input mb-4">
            </div>
            <button type="submit" class="btn btn-secondary p-2 mb-3">Filter</button>
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
