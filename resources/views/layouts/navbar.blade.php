<nav class="navbar-dark bg-dark pt-3">
    <div class="container-fluid">
        <div class="row">
            <div class="col-4">
                <a class="navbar-brand" href="/">
                    <img src="/assets/logo.jpg" alt="" width="30" height="24" class="d-inline-block align-text-top">
                    Yatno's Bike
                </a>
            </div>
            <div class="col-4">
                <form class="d-flex" action="{{ route('productSearch') }}" method="post">
                    @csrf
                    @method('get')
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
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
                        @if (session('role') == 'user')
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/transactions/users/{{ session('user_id') }}">Transaksi</a></li>
                                <li><a class="dropdown-item" href="/forum">Forum Diskusi</a></li>
                                <li><a class="dropdown-item" href="/logout" onclick="return confirm('Anda yakin ingin keluar?')">Keluar</a></li>
                            </ul>             
                        @elseif (session('role') == 'seller')
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/products">Kelola Produk</a></li>
                                <li><a class="dropdown-item" href="/forum">Forum Diskusi</a></li>
                                <li><a class="dropdown-item" href="/logout" onclick="return confirm('Anda yakin ingin keluar?')">Keluar</a></li>
                            </ul>
                        @elseif (session('role') == 'admin')
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                <li><a class="dropdown-item" href="/transactions">Transaksi</a></li>
                                <li><a class="dropdown-item" href="/forum">Forum Diskusi</a></li>
                                <li><a class="dropdown-item" href="/logout" onclick="return confirm('Anda yakin ingin keluar?')">Keluar</a></li>
                            </ul>
                        @endif
                    </div>        
                @else 
                    <div class="dropdown">
                        <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        Masuk/Daftar
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