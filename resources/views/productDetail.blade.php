@include('layouts.header')

        <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.0/css/jquery.dataTables.css">        
        <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.0/js/jquery.dataTables.js"></script>
        <title>{{ $product->name }} | Yatno's Bike</title>
    </head>

    <body>
        @include('layouts.navbar')
        <div class="container mt-4">
            <div class="row">
                <div class="col-5">
                    <img src="/assets/{{ $product->image }}" alt="" style="width: 500px">
                </div>
                <div class="col-4">
                    <h3>{{ $product->name }}</h3>
                    Terjual {{ $product->sold }} | Rating {{ $product->rate }} <br><br>
                    <h5>Deskripsi</h5>
                    {{ $product->description }}
                </div>
                @if (session('role') == 'user')
                    <div class="col">
                        Stok : 
                        <h6>{{ $product->stock }}</h6>
                        Harga :
                        <h6>Rp. {{ $product->price }}</h6>
                        <form action="{{ route('transactionCreate', [$product->id]) }}" method="post">
                            @csrf
                            <h5>---Beli Barang---</h5>
                            <label for="" class="form-label">Jumlah :</label>
                            <input type="number" name="quantity" id="quantity" class="form-control" style="width: 75px" min="1" value="1" max="{{ $product->stock }}" required>
                            <label for="" class="form-label">Alamat :</label>
                            <textarea name="address" id="" cols="" rows="5" class="form-control" required></textarea>
                            <label for="" class="form-label">Total Harga(Rp) :</label>
                            <input type="hidden" name="" id="initial_price" value="{{ $product->price }}">
                            <input type="number" name="price" id="price" class="form-control" style="width: 200px" value="{{ $product->price }}" readonly><br>
                            <label for="" class="form-label">Opsi Pengiriman :</label>
                            <select name="shipping_option" id="" class="form-control" style="width: 200px" required>
                                <option value="jne">JNE</option>
                                <option value="jnt">JNT</option>
                                <option value="sicepat">SiCepat</option>
                            </select><br>
                            <label for="" class="form-label">Opsi Pembayaran :</label>
                            <select name="payment_option" id="" class="form-control" required>
                                <option value="ovo">OVO(081910615218)</option>
                                <option value="gopay">GOPAY(081910615218)</option>
                                <option value="bank">BANK(Mandiri-532526231251)</option>
                            </select><br>
                            <button type="submit" class="btn btn-success">Beli</button>
                        </form>              
                    </div>                    
                @endif

                <h4>Ulasan</h4><br><br>
                <table id="reviews_table" class="display">
                    <thead>
                        <tr>
                            <th>Ulasan</th>
                            <th>Nilai</th>
                            <th>Pembeli</th>
                            <th>Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- data tabel --}}
                        @foreach ($reviews as $review)
                            <tr>
                                <td>{{ $review->review_text }}</td>
                                <td>{{ $review->rate }}</td>
                                <td>{{ $review->name }}</td>
                                <td>{{ $review->created_at }}</td>
                            </tr>                        
                        @endforeach
                    </tbody>
                </table>

            </div>
        </div>
        
        <script type="text/javascript">
        $(document).ready(function () {
            var quantity = $('#quantity')
            var initial_price = $('#initial_price').val()
            quantity.change(function () {
                var total_price = parseInt(quantity.val()) * parseInt(initial_price)
                $('#price').val(total_price)
            })            

            $('#reviews_table').DataTable();
        })
        </script>

    </body>

</html>