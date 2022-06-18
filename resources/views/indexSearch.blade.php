@include('layouts.header')

        <title>Hasil Pencarian {{ $search }} | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <div class="container" style="margin-top: 20;">
            <div class="row" style="border: 1px solid black; padding: 10; border-radius: 10px;">
                <h3>Hasil pencarian untuk '{{ $search }}'</h3>
                @if ($products->isEmpty())
                    <center><h5>Produk tidak ditemukan</h5></center>
                @else
                    @foreach ($products as $product)
                        <div class="col-3">
                            <div class="card" style="width: 18rem;">
                                <img src="/assets/{{ $product->image }}" class="card-img-top" alt="..." style="height: 200;">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>
                                    <p class="card-text">{{ $product->sold }} Terjual | Rating : {{ $product->rate }}</p>
                                    <h6 class="card-text">Rp.{{ $product->price }}</h6>
                                    <a href="{{ route('productDetail', [$product->id]) }}" class="btn btn-primary">Lihat Detail</a>
                                </div>
                            </div>
                        </div>                    
                    @endforeach
                @endif
            </div>
        </div>

    </body>

</html>