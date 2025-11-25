<x-layout.main>
    <div>
        @foreach($workers as $worker)
            <div>
                <div><p class="text-danger">Name: {{ $worker->name }}</p></div>
                <div>Surname: {{ $worker->surname }}</div>
                <div>Email: {{ $worker->email }}</div>
                <div>Age: {{ $worker->age }}</div>
                <div>Phone: {{ $worker->phone }}</div>
                <div>Description: {{ $worker->description }}</div>
                <div>Is married:{{ $worker->is_married }}</div>
                <div>
                    <a href="{{ route('workers.show', $worker) }}">Посмотреть</a>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
</x-layout.main>
