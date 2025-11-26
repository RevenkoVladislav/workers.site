<x-layout.main :title="$worker->name">
    <div class="row g-2 col-sm-12">
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
                <a href="#" class="btn btn-outline-secondary mt-2">Редактировать</a>
            </div>
        </div>
    </div>
</x-layout.main>
