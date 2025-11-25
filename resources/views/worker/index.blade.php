<x-layout.main>
    <div>
        @foreach($workers as $worker)
            <div>
                <div>Name: <a href="{{ route('workers.show', $worker) }}">{{ $worker->name }}</a></div>
                <div>Surname: {{ $worker->surname }}</div>
                <div>Email: {{ $worker->email }}</div>
                <div>Age: {{ $worker->age }}</div>
                <div>Phone: {{ $worker->phone }}</div>
                <div>Description: {{ $worker->description }}</div>
                <div>Is married:{{ $worker->is_married }}</div>
            </div>
            <hr>
        @endforeach
    </div>
</x-layout.main>
