<x-layout.main>
    @if($workings->count())
        <div class="row row-cols-1 row-cols-md-3 mt-3 mb-lg-auto">
            @foreach($workings as $working)
                <div class="col">
                    <div class="card text-dark bg-light border-dark mb-3 p-3 text-center">
                        <div class="card-header">Job Id: {{$working->id}}</div>
                        <div class="card-body">
                            <p class="card-text text"><b>Title: </b>{{ $working->title }}</p>
                            <p class="card-text text-primary-emphasis"><b>Company: </b>{{ $working->company->name }}</p>
                            <p class="card-text"><b>Description: </b>{{ substr($working->description, 0, 15) . '...' }}</p>
                            <p class="card-text"><b>Manager: </b>{{ $working->manager->user->name . ' ' . $working->manager->user->surname }}</p>
                            <p class="card-text text-bg-success"><b>Status: </b>{{ $working->status }}</p>
                            <p class="card-text text-primary"><b>Working date: </b>{{ $working->work_date }}</p>
                            <p class="card-text"><b>Duration: </b>{{ $working->duration }} hours</p>
                            <p class="card-text text-primary"><b>Start: </b>{{ $working->start_time }}</p>
                            <p class="card-text text-primary"><b>End: </b>{{ $working->end_time }}</p>
                            <a href="{{ route('workers.working.show', $working) }}" class="btn btn-outline-secondary mt-2">Read more</a>
{{--                            <a href="{{ route('workers.edit', $worker) }}" class="btn btn-outline-success w-25 mt-2">Edit</a>--}}
{{--                            <form action="{{ route('workers.destroy', $worker) }}" method="post" class="">--}}
{{--                                @csrf--}}
{{--                                @method('DELETE')--}}
{{--                                <input type="submit" value="Delete" class="btn btn-outline-danger mt-2"--}}
{{--                                       onclick="return confirm('Delete {{ $worker->name }} ?')">--}}
{{--                            </form>--}}
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-around">
            {{ $workings->links() }}
        </div>
    @else
        <div>
            <p>actually we dont have jobs for you :(</p>
{{--            <p class="fs-1 text-center text-muted text-break">По вашему запросу - <b>{{ $search ?? null }}</b> ничего не найдено :(</p>--}}
        </div>
    @endif
</x-layout.main>
