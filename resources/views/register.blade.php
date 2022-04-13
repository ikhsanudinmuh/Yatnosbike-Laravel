@include('layouts.header')

        <title>Register | Yatno's Bike</title>
    </head>

    <body style="">
        <center>
            <div class="brand d-flex justify-content-center" style="margin-top: 150px">
                <img src="assets/logo.jpg" alt="">
            </div>
            <form action="{{ route('registerUserPost') }}" method="post" class="col-md-3" style="border-style:groove ; margin-top:50px; border-radius: 10px; padding: 10px">
                @csrf
                <h3>Register</h3>
                @if ($errors->any()) 
                    @foreach ($errors->all() as $e)
                        <div class="alert alert-danger" role="alert">
                            {{ $e }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endforeach
                @endif
                @if (session('registerFailed'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('registerFailed') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="mb-3">
                    <input type="text" name="name" id="" class="form-control" placeholder="Full Name">
                </div>
                <div class="mb-3">
                    <input type="text" name="email" id="" class="form-control" placeholder="Email address">
                </div>
                <div class="mb-3">
                    <input type="password" name="password" id="" class="form-control" placeholder="Password">
                </div>
                <div class="mb-3">
                    <input type="password" name="confirm_password" id="" class="form-control" placeholder="Re-type Password">
                </div>
                <div class="d-flex justify-content-between">
                    <h6>Sudah punya akun? <a href="{{ route('loginUser') }}" style="text-decoration: none">Masuk</a></h6> 
                    <button class="btn btn-primary">Daftar</button>
                </div>
            </form>
        </center>
    </body>

</html>