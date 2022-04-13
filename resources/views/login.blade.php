@include('layouts.header')

        <title>Login | Yatno's Bike</title>
    </head>

    <body style="">
        <center>
            <div class="brand d-flex justify-content-center" style="margin-top: 150px">
                <img src="assets/logo.jpg" alt="">
            </div>
            <form action="{{ route('loginUserPost') }}" method="post" class="col-md-3" style="border-style:groove ; margin-top:50px; border-radius: 10px; padding: 10px">
                @csrf
                <h3>Login</h3>
                @if ($errors->any()) 
                    @foreach ($errors->all() as $e)
                        <div class="alert alert-danger" role="alert">
                            {{ $e }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
                @if (Session('emailNotFound'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session('emailNotFound') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session('passwordError'))
                    <div class="alert alert-danger" role="alert">
                        {{ Session('passwordError') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                @if (Session('registerSuccess'))
                    <div class="alert alert-success" role="alert">
                        {{ Session('registerSuccess') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-3">
                    <input type="text" name="email" id="" class="form-control" placeholder="Email address">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                </div>
                <div class="d-flex justify-content-between">
                    <h6>Belum punya akun? <a href="{{ route('registerUser') }}" style="text-decoration: none">Daftar</a></h6> 
                    <button class="btn btn-primary">Masuk</button>
                </div>
            </form>
        </center>
    </body>

</html>