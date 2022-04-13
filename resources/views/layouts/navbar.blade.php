<nav class="navbar-dark bg-dark pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <a class="navbar-brand" href="/">
                    <img src="assets/logo.jpg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    Yatno's Bike
                </a>
            </div>
            <div class="col-4">
                <form class="d-flex">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
            </div>
            <div class="col"></div>
            <div class="col d-flex">
                @if (session('login') == TRUE)
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ session('name') }}
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/profile">Profile</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </div>
                @else 
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        masuk/daftar
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="/login">Masuk</a></li>
                            <li><a class="dropdown-item" href="/register">Daftar</a></li>
                        </ul>
                    </div>
                @endif
            </div>
        </div>
    </div>
</nav>