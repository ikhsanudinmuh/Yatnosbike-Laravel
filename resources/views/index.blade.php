@include('layouts.header')

        <title>Home | Yatno's Bike</title>
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

                <div class="row" style="margin-top: 10">
                    <div class="col"></div>
                    <div class="col-1">
                        <a href="{{ route('productIndexBicycle') }}">Lihat Lainnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 20;">
            <div class="row" style="border: 1px solid black; padding: 10; border-radius: 10px;">
                <h3>Parts</h3>
                @foreach ($parts as $part)
                    <div class="col-3">
                        <div class="card" style="width: 18rem;">
                            <img src="/assets/{{ $part->image }}" class="card-img-top" alt="..." style="height: 200;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $part->name }}</h5>
                                <p class="card-text">{{ $part->sold }} Terjual | Rating : {{ $part->rate }}</p>
                                <h6 class="card-text">Rp.{{ $part->price }}</h6>
                                <a href="{{ route('productDetail', [$part->id]) }}" class="btn btn-primary">Lihat Detail</a>
                            </div>
                        </div>
                    </div>                    
                @endforeach

                <div class="row" style="margin-top: 10">
                    <div class="col"></div>
                    <div class="col-1">
                        <a href="{{ route('productIndexPart') }}">Lihat Lainnya</a>
                    </div>
                </div>
            </div>
        </div>

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

                <div class="row" style="margin-top: 10">
                    <div class="col"></div>
                    <div class="col-1">
                        <a href="{{ route('productIndexAccessories') }}">Lihat Lainnya</a>
                    </div>
                </div>
            </div>
        </div>

    </body>

</html>
