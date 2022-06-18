@include('layouts.header')

        <title>Kategori : Part | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <div class="container" style="margin-top: 20;">
            <div class="row" style="border: 1px solid black; padding: 10; border-radius: 10px;">
                <h3>Aksesoris</h3>
                @foreach ($accessories as $accessories)
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="/assets/{{ $accessories->image }}" class="card-img-top" alt="..." style="height: 200;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $accessories->name }}</h5>
                                <p class="card-text">{{ $accessories->sold }} Terjual | Rating : {{ $accessories->rate }}</p>
                                <h6 class="card-text">Rp.{{ $accessories->price }}</h6>
                                <a href="{{ route('productDetail', [$accessories->id]) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>                    
                @endforeach
            </div>
        </div>

    </body>

</html>