@props([
  'title' => 'Workers',
  'main_page' => 'Workers',
  'main_link' => 'workers.index',
])
    <!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>

<div class="container-lg">

    <nav class="navbar navbar-expand-lg navbar-light bg-light p-2 mb-2">
        <a class="navbar-brand" href="{{ route($main_link) }}">{{ $main_page }}</a>


        <div class="collapse navbar-collapse" id="navbar">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                @if(auth()->user()?->role->name === 'Manager')
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('workers.create') }}">Create Worker</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Create Job</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('workers.working.index') }}">Look job</a>
                    </li>
                @endif

                @if(auth()->user()?->role->name === 'Worker')
                    <li class="nav-item">
                        <a class="nav-link" href="#">Personal</a>
                    </li>
                @endif

                @if(auth()->user())
                    <form action="{{ route('logout') }}" method="post">
                        @csrf
                        <button class="btn btn-outline-secondary" type="submit">logout</button>
                    </form>
                @endif

            </ul>

            <form class="d-flex" action="{{ route('workers.index') }}" method="get">
                <input class="form-control me-2" type="search" name="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

        </div>
    </nav>

</div>

<div class="container-lg">

    @if(session('success'))
        <div class="text-white bg-success">
            {{ session('success') }}
        </div>
    @endif

    {{ $slot }}

</div>


</body>
</html>
