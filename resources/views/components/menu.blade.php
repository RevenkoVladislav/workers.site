<nav class="navbar navbar-expand-lg navbar-light bg-light p-2 mb-2">
        <a class="navbar-brand" href="{{ route($main_link) }}">{{ $main_page }}</a>


        <div class="collapse navbar-collapse" id="navbar">

            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('workers.create') }}">Create</a>
                </li>
            </ul>

            <form class="d-flex" action="#" method="get">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>

        </div>
</nav>





