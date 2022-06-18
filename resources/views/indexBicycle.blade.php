@include('layouts.header')

        <title>Kategori : Sepeda | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <div class="container" style="margin-top: 20;">
            <div class="row" style="border: 1px solid black; padding: 10; border-radius: 10px;">
                <h3>Sepeda</h3>
                @foreach ($bicycles as $bicycle)
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="/assets/{{ $bicycle->image }}" class="card-img-top" alt="..." style="height: 200;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $bicycle->name }}</h5>
                                <p class="card-text">{{ $bicycle->sold }} Terjual | Rating : {{ $bicycle->rate }}</p>
                                <h6 class="card-text">Rp.{{ $bicycle->price }}</h6>
                                <a href="{{ route('productDetail', [$bicycle->id]) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>                    
                @endforeach
            </div>
        </div>

    </body>

</html>