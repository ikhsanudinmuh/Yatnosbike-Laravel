@include('layouts.header')

        <title>Home | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <div class="container" style="margin-top: 20;">
            <div class="row" style="border: 1px solid black; padding: 10; border-radius: 10px;">
                <h3>SEPEDA</h3>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Bicycle/25-bicycle-mtb-bike-png-image.png" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Mountain Bike 1</h5>
                            <p class="card-text">100 Terjual</p>
                            <h6 class="card-text">Rp.4.000.000</h6>
                            <a href="{{ route('detailProduct') }}" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Bicycle/ba0b07e461b7158fbb725401ac4e07cd.png" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Road Bike 2</h5>
                            <p class="card-text">50 Terjual</p>
                            <h6 class="card-text">Rp.4.500.000</h6>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Bicycle/Downhill-Mountain-Bike-Transparent.png" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Mountain Bike 2</h5>
                            <p class="card-text">150 Terjual</p>
                            <h6 class="card-text">Rp.5.000.000</h6>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Bicycle/Volck-Zeolite-9s-Carbon-Fiber-Folding-Bike.webp" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Folding Bike 1</h5>
                            <p class="card-text">50 Terjual</p>
                            <h6 class="card-text">Rp.4.000.000</h6>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 10">
                    <div class="col"></div>
                    <div class="col-1">
                        <a href="#">Lihat Lainnya</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 20;">
            <div class="row" style="border: 1px solid black; padding: 10; border-radius: 10px;">
                <h3>Parts</h3>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Parts/Chatillon-X12_med_900.png" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Frame Sepeda</h5>
                            <p class="card-text">10 Terjual</p>
                            <h6 class="card-text">Rp.1.000.000</h6>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Parts/Picture2.png" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Fork Sepeda</h5>
                            <p class="card-text">50 Terjual</p>
                            <h6 class="card-text">Rp.1.500.000</h6>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Parts/Picture3.png" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Rear Derailleur</h5>
                            <p class="card-text">150 Terjual</p>
                            <h6 class="card-text">Rp.1.000.000</h6>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card" style="width: 18rem;">
                        <img src="/assets/Parts/Picture7.png" class="card-img-top" alt="..." style="height: 200;">
                        <div class="card-body">
                            <h5 class="card-title">Handlebar</h5>
                            <p class="card-text">50 Terjual</p>
                            <h6 class="card-text">Rp.4.000.000</h6>
                            <a href="#" class="btn btn-primary">Lihat Detail</a>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 10">
                    <div class="col"></div>
                    <div class="col-1">
                        <a href="#">Lihat Lainnya</a>
                    </div>
                </div>
            </div>
        </div>
    </body>

</html>
